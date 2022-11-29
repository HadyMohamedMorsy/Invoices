<?php

namespace App\Http\Controllers\Actions\Products;

use App\Traits\LanguagesTrait;

use App\Models\products;
use App\Models\Catagories;


class ActionProducts{

        // Last Language
    use LanguagesTrait;

    public function GetProducts()
    {   

        return products::where('lang_id' , $this->GetIdLang())->paginate(6);
    
    }

    public function GetCatagories()
    {   

        return  Catagories::where('lang_id' , $this->GetIdLang())->get();
    
    }
    
}
