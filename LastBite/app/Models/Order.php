<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function pickup()
    {
        return $this->belongsTo(Pickup::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
