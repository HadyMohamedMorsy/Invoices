<?php

namespace App\Http\Controllers\Actions\catagories;

use App\Traits\LanguagesTrait;

use App\Models\Catagories;
use App\Models\Languages;



class ActionCatagoriesSearch{

        // Last Language
    use LanguagesTrait;

    public function search($request)
    {   

        $Lang = $request->Lang;

        $LangId =  Languages::where('Language_name' , $Lang)->first();

        return Catagories::where('name_cat' , 'LIKE' , '%'.$request->search.'%')->where('lang_id' ,  $LangId->id)->get();
    }
    
}
