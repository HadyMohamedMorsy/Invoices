<?php

namespace App\Http\Controllers\Actions\catagories;

use App\Models\Catagories;

use App\Traits\LanguagesTrait;
use App\Traits\UploadFileTrait;


class ActionCatagoriesMulti{

    // Last Language
    use LanguagesTrait;
    use UploadFileTrait;

    public function ActionCatagoriesMulti($request)
    {   
                
        // Uploaded The Image On The system 
            $name_image = $this->GetFile($request->file);

            foreach($this->LanguagesCount() as $key){
                
                $RequestFiledLang = 'name_cat_'.$key->Language_name;
                
                Catagories::create([
                    'name_cat'            => trim($request[$RequestFiledLang]),
                    'lang_id'             => $key->id,
                    'image_name'          => $name_image,
                    'translation_id'      => $request->translation_id,
                ]);
            }

            $this->UploadFile($request->file , 'images/Catagories' , $name_image);

    }
    
}
