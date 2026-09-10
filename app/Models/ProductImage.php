<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'image_path',
        'is_primary',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'is_primary' => 'boolean',
        ];
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the full URL for the image.
     * Handles both external URLs (http...) and local storage paths.
     */
    public function getImageUrlAttribute(): string
    {
        $path = $this->image_path;
        if (empty($path)) {
            return asset('images/hero-banner.jpg');
        }
        if (str_starts_with($path, 'http')) {
            return $path;
        }
        if (file_exists(public_path('images/' . $path))) {
            return asset('images/' . $path);
        }
        if (file_exists(public_path('images/products/' . basename($path)))) {
            return asset('images/products/' . basename($path));
        }
        return asset('storage/' . $path);
    }
}
