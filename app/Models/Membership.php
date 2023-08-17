<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    use HasFactory;

    protected $fillable = [
        'uid',
        'nama_membership',
        'harga_membership',
        'jumlah_voucher',
        'sharing_profit',
        'discount_product',
        'periode',
        'satuan_periode'
    ];

    public function registration() {
        return $this->hasOne(Registration::class);
    }
}
