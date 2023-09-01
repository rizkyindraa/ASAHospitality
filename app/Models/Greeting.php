<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Greeting extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'subtitle',
        'yt_link',
        'greeting_file',
        'greeting_picture'
    ];
}
