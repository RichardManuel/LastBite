<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Restaurant extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'restaurants';
    protected $primaryKey = 'RestaurantID';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true; // Atur true jika kamu pakai created_at dan updated_at

    protected $fillable = [
        'email',
        'password',
        'status_approval',
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
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
        // Tambahkan jika 'best_before' adalah date:
        // 'best_before' => 'date',
    ];

    /**
     * Generate restaurant_id secara otomatis saat create (ST001, ST002, dst)
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($restaurant) {
            $lastId = self::orderBy('RestaurantID', 'desc')->first();
            $newNumber = $lastId ? $lastId->RestaurantID + 1 : 1;
            $restaurant->RestaurantID = $newNumber;
        });
    }
}
