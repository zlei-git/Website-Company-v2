<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Collection;
use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['category', 'images' => function ($q) {
            $q->where('is_primary', true);
        }])->where('status', 'active');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        if ($request->filled('collection')) {
            $query->whereHas('collections', function ($q) use ($request) {
                $q->where('slug', $request->collection);
            });
        }

        if ($request->filled('price_min')) {
            $query->where('price', '>=', $request->price_min);
        }
        if ($request->filled('price_max')) {
            $query->where('price', '<=', $request->price_max);
        }

        if ($request->filled('availability')) {
            if ($request->availability === 'in_stock') {
                $query->where('stock', '>', 0);
            } elseif ($request->availability === 'out_of_stock') {
                $query->where('stock', '<=', 0);
            }
        }

        $sort = $request->get('sort', 'newest');
        switch ($sort) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'popular':
                $query->orderBy('views_count', 'desc');
                break;
            case 'newest':
            default:
                $query->latest();
                break;
        }

        $products = $query->paginate(12)->withQueryString();
        
        $categories = Category::where('status', true)->get();
        $collections = Collection::where('status', true)->get();

        return view('customer.products.index', compact('products', 'categories', 'collections'));
    }

    public function show($slug)
    {
        $product = Product::with([
            'category', 
            'images', 
            'reviews' => function ($q) {
                $q->where('is_approved', true)->with('user')->latest();
            }, 
            'collections'
        ])
        ->where('slug', $slug)
        ->where('status', 'active')
        ->firstOrFail();

        $product->increment('views_count');

        $relatedProducts = Product::with(['category', 'images' => function ($q) {
                $q->where('is_primary', true);
            }])
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('status', 'active')
            ->take(4)
            ->get();

        $canReview = false;
        $hasReviewed = false;

        if (Auth::check()) {
            $user = Auth::user();
            
            $canReview = Order::where('user_id', $user->id)
                ->whereIn('status', ['completed', 'delivered'])
                ->whereHas('items', function ($q) use ($product) {
                    $q->where('product_id', $product->id);
                })
                ->exists();

            $hasReviewed = Review::where('user_id', $user->id)
                ->where('product_id', $product->id)
                ->exists();
        }

        return view('customer.products.show', compact('product', 'relatedProducts', 'canReview', 'hasReviewed'));
    }
}
