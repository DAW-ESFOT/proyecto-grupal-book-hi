<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Book extends Model
{
    protected $fillable = [
        'title',
        'author',
        'editorial',
        'year_edition',
        'price',
        'pages',
        'synopsis',
        'cover_page',
        'back_cover',];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($book) {
            $book->user_id = Auth::id();
        });
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function businesses()
    {
        return $this->belongsToMany('App\Models\Business')->withTimestamps()->withPivot('available', 'new');
    }

}


