<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Restaurant extends Model
{
    use HasFactory;

    // Beri tahu Laravel nama tabel yang benar
    protected $table = 'restaurants';

    // Pastikan 'status' ada di dalam $fillable
    protected $fillable = [
        'restaurant_application_id',
        'name',
        'location',
        'rating',
        'reviews_count',
        'status',
        'operational_time',
        'description',
        'food_type',
        'applicant_name',
        'email',
        'telephone',
        'bank_account',
        'account_name',
        'pricing',
        'best_before',
        'picture_of_restaurant',
        'picture_of_products',
        'lunch_stock',   
        'dinner_stock',
    ];

    public function application()
    {
        return $this->belongsTo(RestaurantApplication::class, 'restaurant_application_id');
    }

    protected $casts = [
        'pricing' => 'integer',
        // Pastikan Laravel memperlakukan created_at sebagai objek Carbon
        'created_at' => 'datetime', 
        'updated_at' => 'datetime',
        'lunch_stock' => 'integer',  // <-- Tambahkan ini
        'dinner_stock' => 'integer',
    ];
    

    public function isNew(): bool
    {
        // 'created_at' adalah objek Carbon karena sudah di-cast
        // diffInDays() akan menghitung selisih hari dengan tanggal saat ini (now)
        // Kita anggap 1 bulan adalah sekitar 30 hari
        return $this->created_at->diffInDays(Carbon::now()) <= 30;
    }
}