<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlists = Wishlist::with(['product' => function ($q) {
                $q->with(['images' => function ($qi) {
                    $qi->where('is_primary', true);
                }]);
            }])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('customer.wishlist.index', compact('wishlists'));
    }

    public function toggle(Product $product)
    {
        $user = Auth::user();
        
        $wishlist = Wishlist::where('user_id', $user->id)
            ->where('product_id', $product->id)
            ->first();

        if ($wishlist) {
            $wishlist->delete();
            return back()->with('success', 'Product removed from wishlist.');
        } else {
            Wishlist::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
            ]);
            return back()->with('success', 'Product added to wishlist.');
        }
    }

    public function moveToCart(Product $product)
    {
        $user = Auth::user();

        $wishlist = Wishlist::where('user_id', $user->id)
            ->where('product_id', $product->id)
            ->first();

        if ($wishlist) {
            $wishlist->delete();

            if ($product->stock > 0) {
                $cartItem = CartItem::where('user_id', $user->id)
                    ->where('product_id', $product->id)
                    ->first();

                if ($cartItem) {
                    $cartItem->increment('quantity');
                } else {
                    CartItem::create([
                        'user_id' => $user->id,
                        'product_id' => $product->id,
                        'quantity' => 1,
                    ]);
                }
                return back()->with('success', 'Product moved to cart successfully.');
            } else {
                return back()->with('error', 'Product is currently out of stock.');
            }
        }

        return back()->with('error', 'Product not found in wishlist.');
    }
}
