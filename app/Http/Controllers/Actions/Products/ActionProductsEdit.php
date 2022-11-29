<?php

namespace App\Http\Controllers\Actions\Products;

use App\Traits\LanguagesTrait;

use App\Models\products;


class ActionProductsEdit{

        // Last Language
    use LanguagesTrait;

    public function GetProductRelatedCategory($id){

       return products::where('translation_id' , $id)->where('lang_id' , $this->GetIdLang())->with(['category' => function($q){
            $q->where('lang_id' , $this->GetIdLang());
        }])->first();

    }

    public function getCategory($id){
        
        return $this->GetProductRelatedCategory($id)->category;
    }
    
}
