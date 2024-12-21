<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, HasFactory;

    const CREATED_AT = 'dateCreated';
    const UPDATED_AT = 'dateUpdated';

    protected $fillable = [
        'google_id',
        'email',
        'password',
        'fullname',
        'phone',
        'birthday',
        'address',
        'role',
        'status',
        'email_verified_at'
    ];

    protected $hidden = [
        'password'
    ];
    protected $dates = [
        'email_verified_at',
    ];

    protected $casts = [
        'birthday' => 'date',
        'dateCreated' => 'datetime',
        'dateUpdated' => 'datetime'
    ];
}
