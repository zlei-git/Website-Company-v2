<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Collection;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    public function index()
    {
        $collections = Collection::where('status', true)
            ->withCount(['products' => function ($q) {
                $q->where('status', 'active');
            }])
            ->get();

        return view('customer.collections.index', compact('collections'));
    }

    public function show($slug)
    {
        $collection = Collection::where('slug', $slug)->where('status', true)->firstOrFail();
        
        $products = $collection->products()
            ->with(['category', 'images' => function ($q) {
                $q->where('is_primary', true);
            }])
            ->where('products.status', 'active')
            ->paginate(12);

        return view('customer.collections.show', compact('collection', 'products'));
    }
}
