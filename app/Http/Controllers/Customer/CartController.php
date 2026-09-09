<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Coupon;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = CartItem::with(['product' => function ($q) {
                $q->with(['images' => function ($qi) {
                    $qi->where('is_primary', true);
                }]);
            }])
            ->where('user_id', Auth::id())
            ->get();

        $subtotal = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        $coupon = $this->getAppliedCoupon();
        $discount = 0;

        if ($coupon) {
            $discount = $this->calculateDiscount($coupon, $subtotal);
        }

        $total = max(0, $subtotal - $discount);

        return view('customer.cart.index', compact('cartItems', 'subtotal', 'discount', 'total', 'coupon'));
    }

    public function add(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'nullable|integer|min:1'
        ]);

        $quantity = $request->input('quantity', 1);

        if ($product->stock < $quantity) {
            return back()->with('error', 'Not enough stock available.');
        }

        $cartItem = CartItem::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->first();

        if ($cartItem) {
            $newQuantity = $cartItem->quantity + $quantity;
            if ($product->stock < $newQuantity) {
                 return back()->with('error', 'Cannot add more. Not enough stock available.');
            }
            $cartItem->update(['quantity' => $newQuantity]);
        } else {
            CartItem::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'quantity' => $quantity,
            ]);
        }

        return back()->with('success', 'Product added to cart.');
    }

    public function update(Request $request, CartItem $cartItem)
    {
        if ($cartItem->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'quantity' => 'required|integer'
        ]);

        $quantity = $request->quantity;

        if ($quantity <= 0) {
            $cartItem->delete();
            return back()->with('success', 'Item removed from cart.');
        }

        if ($cartItem->product->stock < $quantity) {
            return back()->with('error', 'Not enough stock available.');
        }

        $cartItem->update(['quantity' => $quantity]);

        return back()->with('success', 'Cart updated.');
    }

    public function remove(CartItem $cartItem)
    {
        if ($cartItem->user_id !== Auth::id()) {
            abort(403);
        }

        $cartItem->delete();

        return back()->with('success', 'Item removed from cart.');
    }

    public function clear()
    {
        CartItem::where('user_id', Auth::id())->delete();
        Session::forget('coupon');
        
        return back()->with('success', 'Cart cleared.');
    }

    public function applyCoupon(Request $request)
    {
        $request->validate([
            'code' => 'required|string'
        ]);

        $code = $request->code;
        $coupon = Coupon::where('code', $code)->first();

        if (!$coupon) {
            return back()->with('error', 'Invalid coupon code.');
        }

        if (!$coupon->is_active) {
            return back()->with('error', 'This coupon is no longer active.');
        }

        $now = now();
        if ($coupon->start_date && $now->lt($coupon->start_date)) {
            return back()->with('error', 'This coupon is not yet active.');
        }
        if ($coupon->end_date && $now->gt($coupon->end_date)) {
            return back()->with('error', 'This coupon has expired.');
        }

        if ($coupon->usage_limit !== null && $coupon->times_used >= $coupon->usage_limit) {
            return back()->with('error', 'This coupon usage limit has been reached.');
        }

        $subtotal = CartItem::where('user_id', Auth::id())->get()->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        if ($coupon->min_purchase !== null && $subtotal < $coupon->min_purchase) {
            return back()->with('error', 'Minimum purchase requirement not met for this coupon.');
        }

        Session::put('coupon', $coupon);

        return back()->with('success', 'Coupon applied successfully.');
    }

    public function removeCoupon()
    {
        Session::forget('coupon');
        return back()->with('success', 'Coupon removed.');
    }

    private function getAppliedCoupon()
    {
        $sessionCoupon = Session::get('coupon');
        if (!$sessionCoupon) {
            return null;
        }

        if ($sessionCoupon instanceof Coupon) {
            return $sessionCoupon;
        }

        if (is_array($sessionCoupon) && isset($sessionCoupon['id'])) {
            return Coupon::find($sessionCoupon['id']);
        }

        if (is_numeric($sessionCoupon)) {
            return Coupon::find($sessionCoupon);
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
