<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amenity extends Model
{
    use HasFactory;

    protected $fillable = [
        'fitur',
        'id_villa'
    ];

    public function villaid() {
    	return $this->belongsTo(Villa::class, 'id_villa');
    }
}
