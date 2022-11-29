<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;

use App\Traits\LanguagesTrait;

class MultiStore extends FormRequest
{

    use LanguagesTrait;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
            foreach($this->LanguagesCount() as $key){
                $validFiledName[] = 'name_pro_'.$key->Language_name;
                $validFiledDesc[] = 'des_pro_'.$key->Language_name;
            }
            
            foreach($validFiledName as $filed){

                $validFiledName[$filed] = 'required|unique:products,name_product|max:50';
            } 

            foreach($validFiledDesc as $filed){
                
                $validFiledDesc[$filed] = 'required';
            } 

            $validation_second = array('file' => 'required|max:10000|mimes:pdf,png,jpg'); 

            $validation = $validFiledName + $validFiledDesc;

            $allValidation =  array_merge($validation , $validation_second);

            return $allValidation;

    }
}
