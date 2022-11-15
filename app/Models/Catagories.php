<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catagories extends Model
{
    use HasFactory;

        
    protected $fillable = ['name_cat', 'lang_id' , 'image_name','translation_id'];

        public function product(){

            return $this->belongsToMany(products::class, 'product_category', 'category_id', ' product_id' , 'translation_id' ,'translation_id');
            
        }

}
 