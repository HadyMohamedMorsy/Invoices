<?php

namespace App\Http\Controllers\Actions\catagories;

use App\Traits\LanguagesTrait;
use App\Traits\UploadFileTrait;


use App\Models\Catagories;


class ActionCatagoriesMultiUpdate{

        // Last Language
    use LanguagesTrait;
    use UploadFileTrait;

    public function UpdateManyCatagoriesLanguage($request , $id)
    {   

        $showCategories =  Catagories::where('translation_id' , $id)->get();

        $TakeImage =  $showCategories->first()->image_name;
        

        $file_path = public_path().'/images/Catagories/'.$TakeImage;


        // Uploaded The Image On The system 
        $name_image = $this->GetFile($request->file);


        if($file_path) {

            unlink($file_path);
        }

        foreach($this->LanguagesCount() as $key){

            $Languages[] = $key->Language_name;
        }

        $i = 0;

        foreach($showCategories as $category) {

            $category->update([
                'name_cat'      => trim($request['name_cat_'.$Languages[$i]]),
                'image_name'    => $name_image, 
            ]);

            $i++;
        }
        
        $this->UploadFile($request->file , 'images/Catagories' , $name_image);
    
    }

    
}
