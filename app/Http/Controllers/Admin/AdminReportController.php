<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class AdminReportController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->input('start_date', Carbon::now()->subDays(30)->format('Y-m-d'));
        $endDate = $request->input('end_date', Carbon::now()->format('Y-m-d'));
        
        $start = Carbon::parse($startDate)->startOfDay();
        $end = Carbon::parse($endDate)->endOfDay();
        
        // Total revenue in period
        $totalRevenue = Order::where('status', 'completed')
            ->whereBetween('created_at', [$start, $end])
            ->sum('total');
            
        // Total orders in period
        $totalOrders = Order::whereBetween('created_at', [$start, $end])->count();
        
        // New customers in period
        $newCustomers = User::where('role', 'customer')
            ->whereBetween('created_at', [$start, $end])
            ->count();
            
        // Average order value
        $averageOrderValue = $totalOrders > 0 ? $totalRevenue / $totalOrders : 0;
        
        // Daily revenue for chart
        $dailyRevenue = [];
        $dates = [];
        $period = CarbonPeriod::create($start, $end);
        
        foreach ($period as $date) {
            $dateString = $date->format('Y-m-d');
            $dates[] = $date->format('M d');
            
            $revenue = Order::where('status', 'completed')
                ->whereDate('created_at', $dateString)
                ->sum('total');
                
            $dailyRevenue[] = (float) $revenue;
        }
        
        // Top selling products
        $topSellingProducts = Product::select('products.name', DB::raw('SUM(order_items.quantity) as total_sold'))
            ->join('order_items', 'products.id', '=', 'order_items.product_id')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('orders.status', 'completed')
            ->whereBetween('orders.created_at', [$start, $end])
            ->groupBy('products.id', 'products.name')
            ->orderByDesc('total_sold')
            ->take(10)
            ->get();
            
        // Order status distribution
        $orderStatusDistribution = Order::whereBetween('created_at', [$start, $end])
            ->select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();
            
        // Revenue by category
        $revenueByCategory = DB::table('categories')
            ->select('categories.name', DB::raw('SUM(order_items.subtotal) as revenue'))
            ->join('products', 'categories.id', '=', 'products.category_id')
            ->join('order_items', 'products.id', '=', 'order_items.product_id')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('orders.status', 'completed')
            ->whereBetween('orders.created_at', [$start, $end])
            ->groupBy('categories.id', 'categories.name')
            ->orderByDesc('revenue')
            ->get();
            
        return view('admin.reports.index', compact(
            'startDate',
            'endDate',
            'totalRevenue',
            'totalOrders',
            'newCustomers',
            'averageOrderValue',
            'dates',
            'dailyRevenue',
            'topSellingProducts',
            'orderStatusDistribution',
            'revenueByCategory'
        ));
    }
}
