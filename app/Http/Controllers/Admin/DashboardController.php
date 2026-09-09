<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $totalCustomers = User::where('role', 'customer')->count();
        $totalRevenue = Order::where('status', 'completed')->sum('total');

        $recentOrders = Order::with('user')->orderBy('created_at', 'desc')->take(10)->get();
        $lowStockProducts = Product::where('stock', '>', 0)->where('stock', '<=', 5)->take(10)->get();
        $unreadMessagesCount = Message::whereNull('read_at')->count();

        // Monthly revenue and orders for last 12 months
        $monthlyRevenue = [];
        $monthlyOrders = [];
        $months = [];
        
        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->startOfMonth()->subMonths($i);
            $months[] = $date->format('M Y');
            
            $revenue = Order::where('status', 'completed')
                ->whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->sum('total');
            
            $orders = Order::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();
                
            $monthlyRevenue[] = (float) $revenue;
            $monthlyOrders[] = $orders;
        }

        $orderStatusDistribution = Order::select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        $topProductIds = DB::table('order_items')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('orders.status', 'completed')
            ->select('order_items.product_id', DB::raw('SUM(order_items.quantity) as total_sold'))
            ->groupBy('order_items.product_id')
            ->orderByDesc('total_sold')
            ->take(10)
            ->pluck('total_sold', 'product_id');

        $bestSellingProducts = Product::whereIn('id', $topProductIds->keys())
            ->get()
            ->map(function ($product) use ($topProductIds) {
                $product->total_sold = $topProductIds[$product->id] ?? 0;
                return $product;
            })
            ->sortByDesc('total_sold')
            ->values();

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalOrders',
            'totalCustomers',
            'totalRevenue',
            'recentOrders',
            'lowStockProducts',
            'monthlyRevenue',
            'monthlyOrders',
            'months',
            'orderStatusDistribution',
            'bestSellingProducts',
            'unreadMessagesCount'
        ));
    }
}
