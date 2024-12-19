<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    const CREATED_AT = 'dateCreated';
    public $timestamps = false;
    
    protected $fillable = [
        'email',
        'address',
        'phone',
        'content',
        'totalAmount',
        'discountAmount',
        'finalAmount',
        'idUser',
        'idVoucher'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'idUser');
    }

    public function voucher()
    {
        return $this->belongsTo(Voucher::class, 'idVoucher');
    }

    public function voucherUsage()
    {
        return $this->hasOne(VoucherUsage::class, 'idBill');
    }
} 