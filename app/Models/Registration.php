<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    protected $fillable = [
        'tgl_registrasi',
        'no_registrasi',
        'status_penerimaan_membership',
        'tgl_penerimaan_membership',
        'payment',
        'id_member',
        'id_membership'
    ];

    public function memberid() {
    	return $this->belongsTo(Member::class, 'id_member');
    }

    public function membershipid() {
    	return $this->belongsTo(Membership::class, 'id_membership');
    }
}
