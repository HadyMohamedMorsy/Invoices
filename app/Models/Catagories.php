<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catagories extends Model
{
    use HasFactory;

        
    protected $fillable = ['name_cat', 'lang_id' , 'translation_id'];

    public function photo(){

        return $this->morphOne(attachments::class, 'attach');
    }

}
