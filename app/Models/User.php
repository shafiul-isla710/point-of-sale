<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    
    protected $fillable = ['name','email','mobile','password','image'];

    protected $attributes = [

          'otp'=>'0'
    ];

    
    protected $hidden = [
        'remember_token',
        'created_at',
        'updated_at',
    ];

    
    // protected function casts(): array
    // {
    //     return [
    //         'email_verified_at' => 'datetime',
    //         'password' => 'hashed',
    //     ];
    // }
}
