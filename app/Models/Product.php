<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'price_per_3days',
        'stock_total',
        'stock_available',
        'size_info',
        'included_items',
        'status',
        'image',
    ];

    protected $casts = [
        'included_items' => 'array',
        'price_per_3days' => 'integer',
        'stock_total' => 'integer',
        'stock_available' => 'integer',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function rentals()
    {
        return $this->belongsToMany(Rental::class, 'rental_product', 'product_id', 'rental_id');
    }
}
