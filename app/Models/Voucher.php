<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    public $timestamps = false;
    
    protected $fillable = [
        'code',
        'description',
        'discountValue',
        'type',
        'validFrom',
        'validTo',
        'active'
    ];

    protected $casts = [
        'validFrom' => 'datetime',
        'validTo' => 'datetime'
    ];

    public function bills()
    {
        return $this->hasMany(Bill::class, 'idVoucher');
    }

    public function voucherUsages()
    {
        return $this->hasMany(VoucherUsage::class, 'idVoucher');
    }
} 