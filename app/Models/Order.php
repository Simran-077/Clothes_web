<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable =[
         'first_name',
         'last_name',
         'email',
         'telephone',
         'address',
         'city',
         'country',
         'state',
         'comment',
         'total_amount',
    ];

    public function items()
{
    return $this->hasMany(\App\Models\Order_items::class, 'order_id');
}
}
