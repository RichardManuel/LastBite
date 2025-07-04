<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pickup extends Model
{
    protected $fillable = ['time_type', 'start_time', 'end_time'];

    public function stores()
    {
        return $this->belongsToMany(Store::class, 'pickup_stores');
    }

    public function customers()
    {
        return $this->hasMany(Customer::class, 'pickup_id'); // atau 'pickup_time_id' jika itu nama kolom di tabel customers
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'pickup_id'); // atau 'pickup_time_id' jika itu nama kolom di tabel orders
    }
}
