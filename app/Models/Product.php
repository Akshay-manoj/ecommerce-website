<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = true;

    public const STATUS_ACTIVE = 'active';

    protected $fillable = [
        'name', 'slug', 'description', 'price', 'stock', 'category_id', 'status',
    ];

    // The category that the product belongs to
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Query scope for category filter
    public function scopeCategoryId($query, $categoryId)
    {
        if ($categoryId) {
            return $query->where('category_id', $categoryId);
        }

        return $query;
    }

    // Query scope for price range filter
    public function scopePriceRange($query, $minPrice, $maxPrice)
    {
        if ($minPrice) {
            $query->where('price', '>=', $minPrice);
        }
        if ($maxPrice) {
            $query->where('price', '<=', $maxPrice);
        }

        return $query;
    }

    // Query scope for status filter
    public function scopeStatus($query, $status)
    {
        if ($status) {
            return $query->where('status', $status);
        }

        return $query;
    }

    // Query scope for sorting by price
    public function scopeSortBy($query, $sortBy)
    {
        if ($sortBy == 'price_asc') {
            return $query->orderBy('price', 'asc');
        } elseif ($sortBy == 'price_desc') {
            return $query->orderBy('price', 'desc');
        }

        return $query;
    }

    // Query Scopt for product name filter
    public function scopeProductName($query, $name)
    {
        if ($name) {
            return $query->where('name', 'like', "%$name%");
        }
    }
}
