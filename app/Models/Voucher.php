<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;

    protected $fillable = [
        'tgl_voucher',
        'no_voucher',
        'keterangan',
        'penerima',
        'id_user',
        'status',
        'tgl_berubah_status',
    ];

    public function userid() {
    	return $this->belongsTo(User::class, 'id_user');
    }
}
