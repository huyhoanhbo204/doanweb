<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

   
    protected $table = 'bills';

  
    protected $primaryKey = 'id';

    
    protected $fillable = [
        'email',
        'address',
        'phone',
        'content',
        'totalAmount',
        'discountAmount',
        'finalAmount',
        'idUser',
        'idVoucher',
        'payment_method',
        'payment_status',
        'dateCreated',
    ];

    // Define any casts for attributes (if needed)
    protected $casts = [
        'totalAmount' => 'decimal:2',
        'discountAmount' => 'decimal:2',
        'finalAmount' => 'decimal:2',
        'dateCreated' => 'datetime',
    ];

    // Define relationships

    // A bill belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class, 'idUser');
    }

    // A bill can belong to a voucher (nullable)
    public function voucher()
    {
        return $this->belongsTo(Voucher::class, 'idVoucher');
    }
}
