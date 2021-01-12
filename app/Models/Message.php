<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Message extends Model
{
//    use HasFactory;
    protected $fillable = ['message'];

    public function Chat()
    {
        return $this->belongsTo('App\Models\Chat');
    }

}
