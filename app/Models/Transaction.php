<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id', 'doctor_id', 'transaction_code', 'schedule_time',
        'consultation_fee', 'admin_fee', 'total_price',
        'payment_method', 'payment_status', 'transaction_status',
    ];

    /**
     * Get the user (patient) associated with the transaction.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the doctor associated with the transaction.
     */
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    /**
     * Get the services associated with the transaction (Many-to-Many).
     */
    public function services()
    {
        return $this->belongsToMany(Service::class, 'service_transaction')
                    ->withPivot('quantity')
                    ->withTimestamps();
    }
}
