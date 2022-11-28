<?php

namespace App\Http\Controllers\Actions\catagories;

use App\Traits\LanguagesTrait;
use App\Traits\UploadFileTrait;


use App\Models\Catagories;


class ActionCatagoriesUpdate{

        // Last Language
    use LanguagesTrait;
    use UploadFileTrait;

    public function ActionCatagoriesUpdate($request , $id)
    {   

         $showCategory =  Catagories::where('translation_id' , $id)->where('lang_id' , $this->GetIdLang());

        $TakeImage =  $showCategory->first()->image_name;


        $file_path = public_path().'/images/Catagories/'.$TakeImage;


        // Uploaded The Image On The system 
        $name_image = $this->GetFile($request->file);


        if($file_path) {

            unlink($file_path);
        }


       $oldImages =  Catagories::where('translation_id' , $id)->get();

        foreach ($oldImages as $img) {

            Catagories::where('translation_id' , $img->translation_id)->where('lang_id' , $img->lang_id)
            ->update([
                'image_name' => $name_image
            ]);
        }

        $showCategory->update([
            'name_cat'      => trim($request[$this->GetValidInputLang('name_cat')]),
            'image_name'    => $name_image, 
        ]);


        $this->UploadFile($request->file , 'images/Catagories' , $name_image);
    
    }

    
}
