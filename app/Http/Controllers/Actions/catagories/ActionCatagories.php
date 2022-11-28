<?php

namespace App\Http\Controllers\Actions\catagories;

use App\Traits\LanguagesTrait;

use App\Models\Catagories;


class ActionCatagories{

        // Last Language
    use LanguagesTrait;

    public function GetCatagories()
    {   
        return  Catagories::where('lang_id', $this->GetIdLang())->paginate(6);
    
    }
    
}
