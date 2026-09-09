<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Inspiration;
use Illuminate\Http\Request;

class InspirationController extends Controller
{
    public function index(Request $request)
    {
        $query = Inspiration::where('is_published', true)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $articles = $query->orderBy('published_at', 'desc')->paginate(9)->withQueryString();

        $categories = Inspiration::where('is_published', true)
            ->whereNotNull('category')
            ->select('category')
            ->distinct()
            ->pluck('category');

        return view('customer.inspirations.index', compact('articles', 'categories'));
    }

    public function show($slug)
    {
        $inspiration = Inspiration::where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        $inspiration->increment('views_count');

        $relatedArticles = collect();
        if ($inspiration->category) {
            $relatedArticles = Inspiration::where('category', $inspiration->category)
                ->where('id', '!=', $inspiration->id)
                ->where('is_published', true)
                ->take(3)
                ->get();
        }

        return view('customer.inspirations.show', compact('inspiration', 'relatedArticles'));
    }
}
