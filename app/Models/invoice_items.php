<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invoice_items extends Model
{
    use HasFactory;

    public function product(){
        
        return $this->belongsTo(products::class, 'cart_id' , 'translation_id');
    }

    public function users(){

        return $this->belongsTo(Users::class, 'user_id' , 'id');
    }
}
