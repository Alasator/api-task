<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'author_id');
    }

    public function image()
    {
        return $this->belongsTo('App\Models\Image', 'image_id');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment','post_id');
    }
}
