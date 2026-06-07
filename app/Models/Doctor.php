<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'status', 'consultation_fee'];

    /**
     * Get the articles for the doctor.
     */
    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}
