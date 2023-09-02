<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Villa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_villa',
        'subtitle',
        'size',
        'occupancy',
        'bed_type',
        'deskripsi',
        'yt_link',
        'display',
        'floor_plan',
        'ubication',
    ];

    public function amenity() {
        return $this->hasMany(Amenity::class);
    }

    public function gallery() {
        return $this->hasMany(Gallery::class);
    }
}
