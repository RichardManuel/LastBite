<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    public function pickups()
    {
        return $this->belongsToMany(Pickup::class);
    }

    public function customers()
    {
        return $this->hasMany(Customer::class);
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}

