<?php

namespace App\Http\Controllers\Actions\Products;

use App\Traits\LanguagesTrait;
use App\Traits\UploadFileTrait;


use App\Models\products;


class ActionProductsUpdate{

        // Last Language
    use LanguagesTrait;
    use UploadFileTrait;

    public function ActionProductsUpdate($request , $id)
    {   
        
            $showProduct =  products::where('translation_id' , $id)->where('lang_id' , $this->GetIdLang());

            $TakeImage =  $showProduct->first()->image_name;

            $file_path = public_path().'/images/products/'.$TakeImage;


            // Uploaded The Image On The system 
            $name_image = $this->GetFile($request->file);


            if($file_path) {

                unlink($file_path);
            }

            $oldImages =  products::where('translation_id' , $id)->get();

            foreach ($oldImages as $img) {

                products::where('translation_id' , $img->translation_id)->where('lang_id' , $img->lang_id)
                ->update([
                    'image_name' => $name_image,
                    'price'      => $request['number_pro'],
                ]);
            }

            $showProduct->update([
                'name_product'        =>   trim($request[$this->GetValidInputLang('name_pro')]),
                'description'         =>   trim($request[$this->GetValidInputLang('des_pro')]),
                'image_name'          =>   $name_image, 
            ]);

            $this->UploadFile($request->file , 'images/products' , $name_image);

            $showProduct->first()->category()->sync($request->product_category);
    
    }

    
}
