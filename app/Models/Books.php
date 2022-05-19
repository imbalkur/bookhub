<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'author',
        'cover_image',
        'num_pages',
        'price'
    ];
}
