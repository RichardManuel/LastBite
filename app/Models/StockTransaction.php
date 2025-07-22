<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockTransaction extends Model
{
    protected $fillable = [
        'stock_id', 'restaurant_id', 'type', 'quantity', 'final_stock', 'user_id'
    ];
}
