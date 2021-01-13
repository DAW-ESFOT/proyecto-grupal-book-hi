<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Chat extends Model
{
//    use HasFactory;
    protected $fillable = [];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($book) {
            $book->user_id1 = Auth::id();
            $book->user_id2 = Auth::id();
        });
    }

    public function user1()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function user2()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function Messages()
    {
        return $this->hasMany('App\Models\Messages');
    }
}
