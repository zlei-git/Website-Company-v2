<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\CartItem;
use App\Models\CouponUsage;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $cartItems = CartItem::with('product')->where('user_id', $user->id)->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $addresses = Address::where('user_id', $user->id)->get();
        $subtotal = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        $coupon = $this->getAppliedCoupon();
        $discount = 0;

        if ($coupon) {
            $discount = $this->calculateDiscount($coupon, $subtotal);
        }

        $total = max(0, $subtotal - $discount);

        return view('customer.checkout.index', compact('cartItems', 'addresses', 'subtotal', 'discount', 'total', 'coupon'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'address_id' => 'nullable|exists:addresses,id',
            'full_name' => 'required_without:address_id|string|max:255',
            'phone' => 'required_without:address_id|string|max:20',
            'address' => 'required_without:address_id|string|max:255',
            'city' => 'required_without:address_id|string|max:255',
            'state' => 'nullable|string|max:255',
            'postal_code' => 'required_without:address_id|string|max:20',
            'country' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $user = Auth::user();
        
        try {
            DB::beginTransaction();

            $cartItems = CartItem::with('product')->where('user_id', $user->id)->get();

            if ($cartItems->isEmpty()) {
                throw new \Exception('Your cart is empty.');
            }

            foreach ($cartItems as $item) {
                if ($item->product->stock < $item->quantity) {
                    throw new \Exception("Product {$item->product->name} does not have enough stock.");
                }
            }

            if ($request->filled('address_id')) {
                $address = Address::where('user_id', $user->id)->where('id', $request->address_id)->firstOrFail();
            } else {
                $address = Address::create([
                    'user_id' => $user->id,
                    'label' => 'Shipping Address',
                    'full_name' => $request->full_name,
                    'phone' => $request->phone,
                    'address' => $request->address,
                    'city' => $request->city,
                    'state' => $request->state,
                    'postal_code' => $request->postal_code,
                    'country' => $request->country ?? 'Default Country',
                    'is_default' => Address::where('user_id', $user->id)->count() === 0,
                ]);
            }

            $subtotal = $cartItems->sum(function ($item) {
                return $item->product->price * $item->quantity;
            });

            $coupon = $this->getAppliedCoupon();
            $discount = 0;
            $couponId = null;

            if ($coupon) {
                if (!$coupon->is_active || ($coupon->start_date && now()->lt($coupon->start_date)) || ($coupon->end_date && now()->gt($coupon->end_date)) || ($coupon->usage_limit !== null && $coupon->times_used >= $coupon->usage_limit) || ($coupon->min_purchase !== null && $subtotal < $coupon->min_purchase)) {
                     throw new \Exception('The applied coupon is no longer valid.');
                }

                $discount = $this->calculateDiscount($coupon, $subtotal);
                $couponId = $coupon->id;
            }

            $total = max(0, $subtotal - $discount);

            $orderNumber = 'NH-' . now()->format('Ymd') . '-' . strtoupper(\Illuminate\Support\Str::random(5));

            $order = Order::create([
                'user_id' => $user->id,
                'address_id' => $address->id,
                'order_number' => $orderNumber,
                'subtotal' => $subtotal,
                'discount' => $discount,
                'total' => $total,
                'status' => 'pending',
                'coupon_id' => $couponId,
                'notes' => $request->notes,
            ]);

            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'product_name' => $item->product->name,
                    'product_price' => $item->product->price,
                    'quantity' => $item->quantity,
                    'subtotal' => $item->product->price * $item->quantity,
                ]);

                $item->product->decrement('stock', $item->quantity);
            }

            if ($couponId) {
                CouponUsage::create([
                    'coupon_id' => $couponId,
                    'user_id' => $user->id,
                    'order_id' => $order->id,
                ]);
                $coupon->increment('times_used');
            }

            CartItem::where('user_id', $user->id)->delete();
            Session::forget('coupon');

            DB::commit();

            return redirect()->route('checkout.confirmation', $order->id)->with('success', 'Order placed successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function confirmation(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        $order->load(['items.product', 'address', 'coupon']);

        return view('customer.checkout.confirmation', compact('order'));
    }

    private function getAppliedCoupon()
    {
        $sessionCoupon = Session::get('coupon');
        if (!$sessionCoupon) {
            return null;
        }

        if ($sessionCoupon instanceof \App\Models\Coupon) {
            return $sessionCoupon;
        }

        if (is_array($sessionCoupon) && isset($sessionCoupon['id'])) {
            return \App\Models\Coupon::find($sessionCoupon['id']);
        }

        if (is_numeric($sessionCoupon)) {
            return \App\Models\Coupon::find($sessionCoupon);
        }

        return null;
    }

    private function calculateDiscount($coupon, $subtotal)
    {
        if (!$coupon) {
            return 0;
        }

        $discountType = is_array($coupon) ? ($coupon['discount_type'] ?? null) : $coupon->discount_type;
        $discountValue = is_array($coupon) ? ($coupon['discount_value'] ?? 0) : $coupon->discount_value;
        $maxDiscount = is_array($coupon) ? ($coupon['max_discount'] ?? null) : $coupon->max_discount;

        $discount = 0;
        
        if ($discountType === 'percentage') {
            $discount = $subtotal * ((float) $discountValue / 100);
            if ($maxDiscount !== null && $discount > (float) $maxDiscount) {
                $discount = (float) $maxDiscount;
            }
        } elseif ($discountType === 'fixed') {
            $discount = (float) $discountValue;
        }

        return min($discount, $subtotal);
    }
}
