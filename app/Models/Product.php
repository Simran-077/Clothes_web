<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Image;

class Product extends Model
{
    protected $table = 'products'; // optional, add only if your table name isn't "products" by default

    protected $fillable = [
        'name',
        'brand',
        'category',
        'price',
        'offer_price',
        'description',
        'image',
        'status',
    ];

    /**
     * Get all images associated with the product.
     */
   public function images()
{
    return $this->hasMany(Image::class);
}

}
