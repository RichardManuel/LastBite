<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pickup extends Model
{
    protected $fillable = ['time_type', 'start_time', 'end_time'];

    public function restaurants()
    {
        return $this->belongsToMany(Restaurant::class, 'pickup_stores', 'pickup_id', 'restaurant_id');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'pickup_id'); // pastikan users table punya pickup_id
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'pickup_id'); // FK di tabel orders
    }
}
