<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoucherUsage extends Model
{
    use HasFactory;

    // Specify the table name (optional, as Laravel will infer this)
    protected $table = 'voucher_usage';

    // Specify the fillable attributes (fields that can be mass-assigned)
    protected $fillable = [
        'idVoucher',
        'idUser',
        'idBill',
        'usedAt'
    ];
    public $timestamps = false;
    // Define the relationships

    // Each VoucherUsage belongs to a Voucher
    public function voucher()
    {
        return $this->belongsTo(Voucher::class, 'idVoucher');
    }

    // Each VoucherUsage belongs to a User
    public function user()
    {
        return $this->belongsTo(User::class, 'idUser');
    }

    // Each VoucherUsage belongs to a Bill
    public function bill()
    {
        return $this->belongsTo(Bill::class, 'idBill');
    }
}
