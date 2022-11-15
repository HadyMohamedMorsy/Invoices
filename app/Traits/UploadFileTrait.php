<?php
namespace App\Traits;


trait UploadFileTrait {
    
    public function UploadFile($requestFile,$path) {

        // Take Extension 
        $file_extension = $requestFile->getClientOriginalExtension();

        $file_name = time().'.'.$file_extension;

        $requestFile->move($path , $file_name);
    }

}