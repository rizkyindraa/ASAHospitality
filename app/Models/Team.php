<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'posisi',
        'foto',
        'email',
        'no_hp',
        'ig_link',
        'fb_link',
        'tw_link',
        'li_link'
    ];
}
