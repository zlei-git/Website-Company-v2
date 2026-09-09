<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::where('status', true)
            ->withCount(['products' => function ($q) {
                $q->where('status', 'active');
            }])
            ->get();

        return view('customer.categories.index', compact('categories'));
    }

    public function show($slug)
    {
        $category = Category::where('slug', $slug)->where('status', true)->firstOrFail();
        
        $products = $category->products()
            ->with(['category', 'images' => function ($q) {
                $q->where('is_primary', true);
            }])
            ->where('status', 'active')
            ->paginate(12);

        return view('customer.categories.show', compact('category', 'products'));
    }
}
