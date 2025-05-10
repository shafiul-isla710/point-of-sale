<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    protected $fillable =['total','discount','vat','payable','user_id','customer_id'];

    protected $hidden =['created_at','updated_at'];
}
