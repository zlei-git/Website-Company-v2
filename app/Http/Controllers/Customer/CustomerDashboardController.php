<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Order;
use App\Models\Review;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $recentOrders = Order::where('user_id', $user->id)->latest()->take(5)->get();
        $wishlistCount = Wishlist::where('user_id', $user->id)->count();
        $reviewCount = Review::where('user_id', $user->id)->count();
        $totalOrdersCount = Order::where('user_id', $user->id)->count();
        $addresses = Address::where('user_id', $user->id)->get();

        return view('customer.dashboard.index', compact(
            'recentOrders',
            'wishlistCount',
            'reviewCount',
            'totalOrdersCount',
            'addresses'
        ));
    }
}
