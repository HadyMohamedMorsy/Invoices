<?php

namespace App\Http\Controllers\Actions\catagories;

use App\Traits\LanguagesTrait;

use App\Models\Catagories;


class ActionCatagoriesShow{

        // Last Language
    use LanguagesTrait;

    public function ShowCatagoriesRelatedProducts($id)
    {   

      $catagoriesProduct =  Catagories::with(['pro' => function($q){
            $q->where('lang_id' , $this->GetIdLang());
        }])->where('lang_id' , $this->GetIdLang())->where('translation_id' , $id)->get();

        return $catagoriesProduct;
    
    }
    public function GetCatagories($id)
    {   

       return Catagories::where('translation_id' , $id)->where('lang_id' , $this->GetIdLang())->first();
    
    }
    
}
