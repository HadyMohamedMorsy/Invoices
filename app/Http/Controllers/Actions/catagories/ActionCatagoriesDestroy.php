<?php

namespace App\Http\Controllers\Actions\catagories;

use App\Models\Catagories;


class ActionCatagoriesDestroy{

    public function DestroyCategory($id)
    {   

        $showCategory =  Catagories::where('translation_id' , $id);


        $TakeImage =  $showCategory->first()->image_name;

        $file_path = public_path().'/images/Catagories/'.$TakeImage;

        if($file_path) {

            unlink($file_path); //delete from storage
        }

        $GetCatagories =  Catagories::where('translation_id' , $id)->get();

        foreach ($GetCatagories as $category) {
            
            $category->delete();
        }    
    }
    
}
