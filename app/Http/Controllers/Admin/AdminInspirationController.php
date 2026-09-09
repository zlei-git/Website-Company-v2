<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inspiration;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class AdminInspirationController extends Controller
{
    public function index(Request $request)
    {
        $query = Inspiration::query();
        
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }
        
        if ($request->filled('status')) {
            if ($request->status === 'published') {
                $query->where('is_published', true);
            } elseif ($request->status === 'draft') {
                $query->where('is_published', false);
            }
        }
        
        $inspirations = $query->orderBy('created_at', 'desc')->paginate(15)->withQueryString();
        
        return view('admin.inspirations.index', compact('inspirations'));
    }

    public function create()
    {
        return view('admin.inspirations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string',
            'category' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048',
            'is_published' => 'boolean',
        ]);

        $data = $request->except('image');
        $data['slug'] = $this->generateUniqueSlug($request->title);
        $data['is_published'] = $request->has('is_published');
        
        if ($data['is_published']) {
            $data['published_at'] = now();
        }

        if ($request->hasFile('image')) {
            $data['image_path'] = Storage::disk('public')->putFile('inspirations', $request->file('image'));
        }

        Inspiration::create($data);

        return redirect()->route('admin.inspirations.index')->with('success', 'Inspiration post created successfully.');
    }

    public function edit(Inspiration $inspiration)
    {
        return view('admin.inspirations.edit', compact('inspiration'));
    }

    public function update(Request $request, Inspiration $inspiration)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string',
            'category' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048',
            'is_published' => 'boolean',
        ]);

        $data = $request->except('image');
        $data['is_published'] = $request->has('is_published');

        if ($inspiration->title !== $request->title) {
            $data['slug'] = $this->generateUniqueSlug($request->title, $inspiration->id);
        }

        if ($data['is_published'] && is_null($inspiration->published_at)) {
            $data['published_at'] = now();
        } elseif (!$data['is_published']) {
            $data['published_at'] = null;
        }

        if ($request->hasFile('image')) {
            if ($inspiration->image_path) {
                Storage::disk('public')->delete($inspiration->image_path);
            }
            $data['image_path'] = Storage::disk('public')->putFile('inspirations', $request->file('image'));
        }

        $inspiration->update($data);

        return redirect()->route('admin.inspirations.index')->with('success', 'Inspiration post updated successfully.');
    }

    public function destroy(Inspiration $inspiration)
    {
        if ($inspiration->image_path) {
            Storage::disk('public')->delete($inspiration->image_path);
        }
        $inspiration->delete();

        return redirect()->route('admin.inspirations.index')->with('success', 'Inspiration post deleted successfully.');
    }
    
    private function generateUniqueSlug($title, $ignoreId = null)
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $count = 1;

        while (Inspiration::where('slug', $slug)->where('id', '!=', $ignoreId)->exists()) {
            $slug = "{$originalSlug}-{$count}";
            $count++;
        }

        return $slug;
    }
}
