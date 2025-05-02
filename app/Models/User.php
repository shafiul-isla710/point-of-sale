<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

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

    public function category(){
        return $this->hasMany(Category::class);
    }
    public function customer(){
        return $this->hasMany(Customer::class);
    }
    public function product(){
        return $this->hasMany(Product::class);
    }


    
    // protected function casts(): array
    // {
    //     return [
    //         'email_verified_at' => 'datetime',
    //         'password' => 'hashed',
    //     ];
    // }
}
