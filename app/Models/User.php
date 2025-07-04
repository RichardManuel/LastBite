<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // Untuk Auth Laravel
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash; // Untuk hashing password

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'user_id'; // Sesuai skema Anda
    public $incrementing = false;     // Karena user_id bukan auto-increment integer
    protected $keyType = 'string';    // Karena user_id adalah string
    public $timestamps = false;         // Skema SQL awal Anda tidak punya created_at/updated_at

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        // 'user_id', // Diisi oleh database DEFAULT
        'name',
        'email',
        // 'city', // Jika ada di skema dan ingin diisi saat create
        // 'phone', // Jika ada di skema dan ingin diisi saat create
        'password_hash', // Kolom di database Anda
        'role',          // Jika Anda menambahkan kolom role ke tabel users
        'status',        // Jika Anda menambahkan kolom status ke tabel users
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password_hash', // Sembunyikan hash password
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime', // Jika Anda punya kolom ini
        // Kita tidak bisa cast 'password_hash' => 'hashed' karena nama kolomnya beda
        // Hashing akan dilakukan manual atau via mutator
    ];

    /**
     * Mutator untuk mengenkripsi password saat di-set ke atribut 'password_hash'
     * ATAU Anda bisa juga membuat atribut 'password' virtual dan mutatornya.
     * Ini cara langsung jika Anda mengisi 'password_hash' dengan password mentah.
     */
    public function setPasswordHashAttribute($value)
    {
        if (!empty($value)) { // Hanya hash jika ada nilai
            $this->attributes['password_hash'] = Hash::make($value);
        }
    }

    /**
     * Override method untuk Auth Laravel agar menggunakan kolom password_hash.
     */
    public function getAuthPassword()
    {
        return $this->password_hash;
    }

    // Relasi ke Restaurant
    public function restaurant()
    {
        return $this->hasOne(Restaurant::class, 'user_id', 'user_id');
    }
}