<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $fillable = ['name', 'description', 'price', 'category_id','brand_id'];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function carts()
    {
        return $this->belongsToMany(Cart::class, 'cart_items')->withPivot('quantity')->withTimestamps();
    }
    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }
}
