<?php
namespace App\Traits;

use App\Models\Languages;

use LaravelLocalization;

trait LanguagesTrait {
    
    public function Languages() {
        return  Languages::orderBy('id', 'desc')->first()->id;
    }

    public function GetIdLang(){

        return Languages::where('Language_name' , LaravelLocalization::getCurrentLocale())->first()->id;
    }

     // Get GetValidInputLang 
    public function GetValidInputLang($name){

        return $name.'_'.LaravelLocalization::getCurrentLocale();
    }

     // Get GetLanguagesCount 
    public function LanguagesCount(){

        return  Languages::get(['id' , 'Language_name']);
    }
}