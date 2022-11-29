<?php

namespace App\Http\Controllers\Actions\Products;

use App\Models\products;

use App\Traits\LanguagesTrait;
use App\Traits\UploadFileTrait;


class ActionProductsMulti{

    // Last Language
    use LanguagesTrait;
    use UploadFileTrait;

    public function ActionProductsMulti($request)
    {   
                
        // Uploaded The Image On The system 
            $name_image = $this->GetFile($request->file);

            foreach($this->LanguagesCount() as $key){
                
                $RequestFiledLangName = 'name_pro_'.$key->Language_name;
                $RequestFiledLangDesc = 'des_pro_'.$key->Language_name;
                
                products::create([
                    'name_product'        => trim($request[$RequestFiledLangName]),
                    'description'         => trim($request[$RequestFiledLangDesc]),
                    'price'               => $request->number_pro,
                    'lang_id'             => $key->id,
                    'image_name'          => $name_image,
                    'translation_id'      => $request->translation_id,
                ]);
            }

        $this->UploadFile($request->file , 'images/products' , $name_image);

        $latest =   products::orderBy('id', 'desc')->first()->translation_id;

        $product =  products::where('translation_id' , $latest )->where('lang_id' , $this->GetIdLang())->first();

        $product->category()->syncWithoutDetaching($request->product_category);

    }
    
}
