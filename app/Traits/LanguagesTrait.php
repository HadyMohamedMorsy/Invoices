<?php
namespace App\Traits;

use App\Models\Languages;

trait LanguagesTrait {
    
    public function Languages() {

        return  $Languages =  Languages::orderBy('id', 'desc')->first()->id;
        
    }
}