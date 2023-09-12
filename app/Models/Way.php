<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Way extends Model
{
    use HasFactory;

    protected $fillable = [
        'way_name',
        'subtitle',
        'description',
        'way_picture'
    ];
}
