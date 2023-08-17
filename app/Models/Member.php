<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'uid',
        'nama_depan',
        'nama_belakang',
        'jenis_kelamin',
        'no_hp',
        'id_user'
    ];
    protected $primaryKey = 'id';

    public function userid() {
    	return $this->belongsTo(User::class, 'id_user');
    }

    public function registration() {
        return $this->hasOne(Registration::class);
    }
}
