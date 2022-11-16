<?php
namespace App\Traits;


trait UploadFileTrait {
    
    public function GetFile($requestFile) {

        // Take Extension 
        $file_extension = $requestFile->getClientOriginalExtension();

        $file_name = time().'.'.$file_extension;

        return $file_name;
    }

    public function UploadFile($requestFile , $path , $image) {

        $requestFile->move($path , $image);
    }

}