<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['doctor_id', 'title', 'content', 'status', 'views_count'];

    /**
     * Get the doctor that authored the article.
     */
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
