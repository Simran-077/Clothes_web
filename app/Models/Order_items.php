<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order_items extends Model
{
    protected $table = 'order_items';

    protected $fillable = [
        'product_name',
        'image',
        'quantity',
        'unit_price',
        'total',
        'order_id',
    ];
}
