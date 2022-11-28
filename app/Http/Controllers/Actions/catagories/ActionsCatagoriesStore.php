<?php

namespace App\Http\Controllers\Actions\catagories;

//Traits
use App\Traits\LanguagesTrait;
use App\Traits\UploadFileTrait;

//Models
use App\Models\Catagories;

//Google Translate Library
use Stichoza\GoogleTranslate\GoogleTranslate;

class ActionsCatagoriesStore{

    // Last Language
    use LanguagesTrait;

    //upload File
    use UploadFileTrait;

    public function SetCatagories($request)
    {  

        $name_image = $this->GetFile($request->file);

        foreach($this->LanguagesCount() as $key){
            
            $tr = new GoogleTranslate($key->Language_name); // Translates into English
            
            Catagories::create([
                'name_cat'            => trim($tr->translate($request[$this->GetValidInputLang('name_cat')])),
                'lang_id'             => $key->id,
                'image_name'          => $name_image,
                'translation_id'      => $request->translation_id,
            ]);
            
        }
        
        $this->UploadFile($request->file , 'images/Catagories' , $name_image);


    }
    
}
