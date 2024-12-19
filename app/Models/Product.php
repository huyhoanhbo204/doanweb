<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
        'image',
        'price',
        'voucher',
        'hot',
        'description',
        'idCategory',
        'active',
        'discount'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');  // Sử dụng category_id để liên kết
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'idProduct');
    }






    public function scopeFilter($query, $filters)
    {
        if (!empty($filters['search'])) {
            $query->where('name', 'like', '%' . $filters['search'] . '%');
        }

        if (!empty($filters['category_id'])) {
            $query->where('category_id', $filters['category_id']);
        }

        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (!empty($filters['hot'])) {
            $query->where('hot', $filters['hot']);
        }
    }
}
