<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    const CREATED_AT = 'dateCreated';
    const UPDATED_AT = 'dateUpdated';
    
    protected $fillable = [
        'content',
        'rating',
        'idUser',
        'idProduct'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'idUser');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'idProduct');
    }
} 