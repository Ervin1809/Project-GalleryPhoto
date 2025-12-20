<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'file_low_res',
        'file_high_res',
        'uploaded_by',
    ];

    /**
     * Get all reviews for this image
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Get the user who uploaded this image
     */
    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    /**
     * Get users who reviewed this image (many-to-many through reviews)
     */
    public function reviewers()
    {
        return $this->belongsToMany(User::class, 'reviews')
            ->withPivot('comment', 'created_at')
            ->withTimestamps();
    }
}
