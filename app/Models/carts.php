<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class carts extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $hidden = ['cart_id','created_at','updated_at'];


    public function users(){
        return $this->belongsTo(Users::class, 'user_id' , 'id');
    }

    public function cart(){
        
        return $this->hasMany(products::class, 'translation_id' , 'cart_id');
    }

}
