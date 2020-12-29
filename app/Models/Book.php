<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected$fillable = ['title', 'author', 'editorial', 'year_edition', 'price', 'pages', 'synopsis', 'book_status', 'cover_page', 'back_cover', 'donation', 'available_status'];
}
