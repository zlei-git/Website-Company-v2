<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Collection;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AdminCollectionController extends Controller
{
    public function index(Request $request)
    {
        $query = Collection::withCount('products');
        
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        
        $collections = $query->orderBy('name')->paginate(15)->withQueryString();
        
        return view('admin.collections.index', compact('collections'));
    }

    public function create()
    {
        $products = Product::orderBy('name')->get();
        return view('admin.collections.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'status' => 'boolean',
            'products' => 'nullable|array',
            'products.*' => 'exists:products,id',
        ]);

        $data = $request->only(['name', 'description', 'status']);
        $data['slug'] = $this->generateUniqueSlug($request->name);
        $data['status'] = $request->has('status');

        if ($request->hasFile('image')) {
            $data['image_path'] = Storage::disk('public')->putFile('collections', $request->file('image'));
        }

        $collection = Collection::create($data);

        if ($request->has('products')) {
            $collection->products()->sync($request->products);
        }

        return redirect()->route('admin.collections.index')->with('success', 'Collection created successfully.');
    }

    public function edit(Collection $collection)
    {
        $collection->load('products');
        $products = Product::orderBy('name')->get();
        return view('admin.collections.edit', compact('collection', 'products'));
    }

    public function update(Request $request, Collection $collection)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'status' => 'boolean',
            'products' => 'nullable|array',
            'products.*' => 'exists:products,id',
        ]);

        $data = $request->only(['name', 'description', 'status']);
        $data['status'] = $request->has('status');

        if ($collection->name !== $request->name) {
            $data['slug'] = $this->generateUniqueSlug($request->name, $collection->id);
        }

        if ($request->hasFile('image')) {
            if ($collection->image_path) {
                Storage::disk('public')->delete($collection->image_path);
            }
            $data['image_path'] = Storage::disk('public')->putFile('collections', $request->file('image'));
        }

        $collection->update($data);

        if ($request->has('products')) {
            $collection->products()->sync($request->products);
        } else {
            $collection->products()->detach();
        }

        return redirect()->route('admin.collections.index')->with('success', 'Collection updated successfully.');
    }

    public function destroy(Collection $collection)
    {
        if ($collection->image_path) {
            Storage::disk('public')->delete($collection->image_path);
        }
        $collection->delete();

        return redirect()->route('admin.collections.index')->with('success', 'Collection deleted successfully.');
    }

    private function generateUniqueSlug($name, $ignoreId = null)
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $count = 1;

        while (Collection::where('slug', $slug)->where('id', '!=', $ignoreId)->exists()) {
            $slug = "{$originalSlug}-{$count}";
            $count++;
        }

        return $slug;
    }
}
