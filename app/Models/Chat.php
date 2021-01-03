<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Chat extends Model
{
//    use HasFactory;
    protected $fillable = ['message'];

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
        return $this->belongsTo('App\Models\Business');
    }

}
