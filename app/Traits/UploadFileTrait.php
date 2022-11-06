<?php
namespace App\Traits;
use App\Models\attachments;


trait UploadFileTrait {
    
    public function UploadFile($requestFile,$path , $id) {

            $requestFile = $requestFile;
            // Take Extension 
            $file_extension = $requestFile->getClientOriginalExtension();

            $file_name = time().'.'.$file_extension;
            
            // Upload Your File On The Server
            $requestFile->move($path , $file_name);

            // check what is the path it will be inserted
            switch ($path) {
                case "images/catagories":
                    attachments::create([
                        'image_name' => $file_name,
                        'category_id' => $id,
                    ]);
                break;
                case "images/products":
                    attachments::create([
                        'image_name' => $file_name,
                        'product_id' => $id,
                    ]);
                break;
                case "images/users":
                    attachments::create([
                        'image_name' => $file_name,
                        'user_id' => $id,
                    ]);
                break;
                case "images/invoices":
                    attachments::create([
                        'image_name' => $file_name,
                        'user_id' => $id,
                    ]);
                break;
            }
    }
}