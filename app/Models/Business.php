<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Business as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class Business extends Model
{
    use HasFactory;

    protected $fillable = [
        'ruc',
        'name',
        'address',
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($book) {
            $book->user_id = Auth::id();
        });
    }

    public function chats()
    {
        return $this->hasMany('App\Models\Chat');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function books()
    {
        return $this->belongsToMany('App\Models\Book')->withTimestamps()->withPivot('available', 'new');
    }

}
