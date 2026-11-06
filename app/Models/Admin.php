<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'photo',
    ];

    protected $hidden = [
        'password',
    ];

protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
}
