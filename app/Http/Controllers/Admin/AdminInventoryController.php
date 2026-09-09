<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminInventoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('sku', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('stock_status')) {
            $status = $request->stock_status;
            if ($status === 'out_of_stock') {
                $query->where('stock', 0);
            } elseif ($status === 'low_stock') {
                $query->where('stock', '>', 0)->where('stock', '<=', 5);
            } elseif ($status === 'in_stock') {
                $query->where('stock', '>', 5);
            }
        }

        $products = $query->orderBy('name')->paginate(20)->withQueryString();

        return view('admin.inventory.index', compact('products'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'stock' => 'required|integer|min:0',
        ]);

        $product->update([
            'stock' => $request->stock
        ]);

        return redirect()->back()->with('success', "Stock updated successfully for {$product->name}.");
    }
}
