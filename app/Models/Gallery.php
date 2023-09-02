<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'gallery',
        'id_villa'
    ];

    public function villaid() {
    	return $this->belongsTo(Villa::class, 'id_villa');
    }
}
