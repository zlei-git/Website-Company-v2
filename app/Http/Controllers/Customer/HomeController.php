<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Collection;
use App\Models\Inspiration;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::with(['category', 'images' => function ($query) {
            $query->where('is_primary', true);
        }])
        ->where('status', 'active')
        ->where('is_featured', true)
        ->take(6)
        ->get();

        $categories = Category::where('status', true)
            ->withCount(['products' => function ($query) {
                $query->where('status', 'active');
            }])
            ->get();

        $inspirations = Inspiration::where('is_published', true)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();

        $featuredCollection = Collection::with(['products' => function ($query) {
            $query->where('status', 'active')
                ->with(['category', 'images' => function ($q) {
                    $q->where('is_primary', true);
                }]);
        }])
        ->where('status', true)
        ->first();

        return view('customer.home', compact('featuredProducts', 'categories', 'inspirations', 'featuredCollection'));
    }
}
