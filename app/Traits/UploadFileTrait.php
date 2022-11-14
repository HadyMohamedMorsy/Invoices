<?php
namespace App\Traits;
use App\Models\Catagories;


trait UploadFileTrait {
    
    public function UploadFile($requestFile,$path , $id) {

            $requestFile = $requestFile;
            // Take Extension 
            $file_extension = $requestFile->getClientOriginalExtension();

            $file_name = time().'.'.$file_extension;
            
            // Upload Your File On The Server
            $requestFile->move($path , $file_name);

            // check what is the path it will be inserted
            $cat = Catagories::find($id);

            $cat->photo()->create([
                'image_name' => $file_name ,
                'type'       => $file_extension,
            ]);
    }
}