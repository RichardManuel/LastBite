<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class RestaurantApplication extends Model
{
    protected $primaryKey = 'application_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'application_id',
        'restaurant_name',
        'restaurant_location',
        'operational_hours',
        'description',
        'food_type',
        'restaurant_email',
        'password_hash',
        'applicant_name',
        'applicant_phone',
        'pricing_tier',
        'account_bank',
        'bank_account_name',
        'name_accountable',
        'npwp_document_path',
        'authorization_document_path',
        'id_proof_document_path',
        'restaurant_photos',
        'product_photos',
        'best_before',
        'notes',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($application) {
            $lastId = self::orderBy('application_id', 'desc')->first();
            $newNumber = $lastId ? ((int)substr($lastId->application_id, 3)) + 1 : 1;
            $application->application_id = 'APP' . str_pad($newNumber, 7, '0', STR_PAD_LEFT);
        });
    }
}
