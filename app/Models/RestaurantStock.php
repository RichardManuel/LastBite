<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RestaurantStock extends Model
{
    protected $fillable = [
        'restaurant_id',
        'item_name',
        'pickup_time',
        'stock',
    ];
}
