<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VoucherUsage extends Model
{
    protected $table = 'voucher_usage';
    public $timestamps = false;
    
    protected $fillable = [
        'idVoucher',
        'idUser',
        'idBill',
        'usedAt'
    ];

    protected $casts = [
        'usedAt' => 'datetime'
    ];

    public function voucher()
    {
        return $this->belongsTo(Voucher::class, 'idVoucher');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'idUser');
    }

    public function bill()
    {
        return $this->belongsTo(Bill::class, 'idBill');
    }
} 