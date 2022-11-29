<?php

namespace App\Http\Controllers\Actions\Products;

use App\Models\products;


class ActionProductsDestroy{

    public function DestroyProducts($id)
    {   
        
        $showProduct =  products::where('translation_id' , $id);

        $TakeImage =  $showProduct->first()->image_name;

        $file_path = public_path().'/images/products/'.$TakeImage;

        if($file_path) {

            unlink($file_path); //delete from storage
        }

        $products =  products::where('translation_id' , $id)->get();

        foreach ($products as $product) {
            
            $product->delete();
        }    

    }
    
}
