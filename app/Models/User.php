<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\CustomResetPassword;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'city',
        'password',
        'phone',
        'notes',
        'roles',
        'img_path',
        'pickup_id',
        'restaurant_id'
    ];

    protected $hidden = [
        'password',
    ];

    /**
     * Kirim notifikasi reset password
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new CustomResetPassword($token));
    }

    /**
     * Relasi ke restoran (jika user terasosiasi ke restoran, misalnya untuk owner atau preferensi)
     */
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class, 'restaurant_id', 'restaurant_id');
    }

    /**
     * Relasi ke pickup time (jika user memilih waktu pengambilan)
     */
    public function pickup()
    {
        return $this->belongsTo(Pickup::class, 'pickup_id');
    }

    /**
     * Relasi ke banyak order
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
}
