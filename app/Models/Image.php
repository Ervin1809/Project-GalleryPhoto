<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'title',
        'file_low_res',
        'file_high_res',
    ];

    public function reviews(){
        return $this->hasMany(Review::class);
    }
    public function user(){
        return $this->belongsToMany(User::class, 'reviews');
    }

}
