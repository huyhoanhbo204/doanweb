<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable,HasFactory;

    const CREATED_AT = 'dateCreated';
    const UPDATED_AT = 'dateUpdated';

    protected $fillable = [
        'email',
        'password',
        'fullname',
        'phone',
        'birthday',
        'address',
        'role',
        'status'
    ];

    protected $hidden = [
        'password'
    ];

    protected $casts = [
        'birthday' => 'date',
        'dateCreated' => 'datetime',
        'dateUpdated' => 'datetime'
    ];

   
}
