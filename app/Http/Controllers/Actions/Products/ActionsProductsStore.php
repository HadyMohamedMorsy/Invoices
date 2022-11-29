<?php

namespace App\Http\Controllers\Actions\Products;

//Traits
use App\Traits\LanguagesTrait;
use App\Traits\UploadFileTrait;

//Models
use App\Models\products;

//Google Translate Library
use Stichoza\GoogleTranslate\GoogleTranslate;

class ActionsProductsStore{

    // Last Language
    use LanguagesTrait;

    //upload File
    use UploadFileTrait;

    public function SetProducts($request)
    {  
        $name_image = $this->GetFile($request->file);
            
            foreach($this->LanguagesCount() as $key){
                
            $tr = new GoogleTranslate($key->Language_name); // Translates into English

                products::create([
                    'name_product'        => $tr->translate($request[$this->GetValidInputLang('name_pro')]),
                    'description'         => $tr->translate($request[$this->GetValidInputLang('des_pro')]),
                    'price'               => $request['number_pro'],
                    'lang_id'             => $key->id,
                    'image_name'          => $name_image,
                    'translation_id'      => $request->translation_id,
                ]);
                
            }

        $request->file->move('images/products' , $name_image);
        
        $latest =   products::orderBy('id', 'desc')->first()->translation_id;

        $product =  products::where('translation_id' , $latest )->where('lang_id' , $this->GetIdLang())->first();

        $product->category()->syncWithoutDetaching($request->product_category);

    }
    
}
