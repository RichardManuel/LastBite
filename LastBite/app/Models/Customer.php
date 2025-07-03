<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function pickup()
    {
        return $this->belongsTo(PickupTime::class);
    }
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}

