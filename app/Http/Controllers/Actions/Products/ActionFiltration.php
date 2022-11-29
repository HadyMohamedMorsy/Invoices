<?php

namespace App\Http\Controllers\Actions\Products;

use App\Traits\LanguagesTrait;

use App\Models\products;
use App\Models\Catagories;


class ActionFiltration{

        // Last Language
    use LanguagesTrait;

    public function GetFiltration($request)
    {   
      return  Catagories::where('translation_id' , $request->category_Filter)
        ->with(['pro' => function($q){
            $q->where('lang_id',$this->GetIdLang());
        }])->where('lang_id' , $this->GetIdLang())->paginate(6);
    }

    
}
