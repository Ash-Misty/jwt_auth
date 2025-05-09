<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Fields you can mass-assign (like during create or update)
    protected $fillable = [
        'name', 'email', 'password', 'mobile_no', 'education'
    ];


    // Hide sensitive fields when converting to array/json
    protected $hidden = [
        'password',
        'remember_token',
    ];
}
