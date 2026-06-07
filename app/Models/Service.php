<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'description', 'availability', 'price', 'category_id'];

    /**
     * Get the category that owns the service.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the transactions associated with the service (Many-to-Many).
     */
    public function transactions()
    {
        return $this->belongsToMany(Transaction::class, 'service_transaction')
                    ->withPivot('quantity')
                    ->withTimestamps();
    }
}
