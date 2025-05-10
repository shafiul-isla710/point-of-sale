<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function invoice(){
        return $this->hasMany(Invoice::class);
    }

    protected $fillable = ['name','email','mobile','address','user_id'];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
