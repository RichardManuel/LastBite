<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Restaurant extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'restaurants';
    protected $primaryKey = 'restaurant_id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false; // Ganti ke true jika pakai created_at dan updated_at

    protected $fillable = [
        'email',
        'password',
        'status',
        'location',
        'operational_hours',
        'description',
        'food_type',
        'name',
        'applicant_name',
        'telephone',
        'account_bank',
        'bank_account_name',
        'name_accountable',
        'pricing_tier',
        'best_before',
        'restaurant_picture_path',
        'product_sold_picture_path',
        'id_proof_document_path',
        'npwp_document_path',
        'authorization_document_path',
        'rating',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
        // 'best_before' => 'date', // uncomment jika tipe tanggal
    ];

    /**
     * Auto-generate restaurant_id: ST001, ST002, dst.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($restaurant) {
            $lastId = self::orderBy('restaurant_id', 'desc')->first();
            $newNumber = $lastId ? ((int) substr($lastId->restaurant_id, 2)) + 1 : 1;
            $restaurant->restaurant_id = 'ST' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
        });
    }

    public function stocks()
    {
        return $this->hasMany(\App\Models\RestaurantStock::class, 'restaurant_id', 'restaurant_id');
    }

    public function pickups(): BelongsToMany
    {
        return $this->belongsToMany(Pickup::class, 'pickup_restaurants', 'restaurant_id', 'pickup_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'restaurant_id', 'restaurant_id');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'restaurant_id', 'restaurant_id');
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }


    public function isNew()
    {
        return $this->created_at && $this->created_at->gt(now()->subDays(7));
    }

    public function getRouteKeyName()
    {
        return 'restaurant_id';
    }
}
