<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Order extends Model
{
    protected $fillable = [
        'order_id',
        'user_id',
        'restaurant_id',
        'pickup_id',
        'item_name',
        'item_price',
        'status',
        'payment_method',
    ];

    public $incrementing = false;
    protected $primaryKey = 'order_id';
    protected $keyType = 'string';

    public function pickup()
    {
        return $this->belongsTo(Pickup::class);
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class, 'restaurant_id', 'restaurant_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function generateNewId()
{
    do {
        $id = 'OR' . str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
    } while (self::where('order_id', $id)->exists());

    return $id;
}

    
}
