<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    use HasFactory;

    // protected $hidden = ['pivot'];
    protected $fillable = ['name_product', 'description'  , 'price' ,'lang_id' , 'image_name' , 'translation_id'];

    public function category(){

        return $this->belongsToMany(Catagories::class, 'product_category', 'product_id', 'category_id' , 'translation_id' , 'translation_id');
    }
}
