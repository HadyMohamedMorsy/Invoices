<?php

namespace App\Http\Requests\Catagories;

use Illuminate\Foundation\Http\FormRequest;

use App\Traits\LanguagesTrait;


class Multicatagory extends FormRequest
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

            $validFiled[] = 'name_cat_'.$key->Language_name;
        }
        
        foreach($validFiled as $filed){

            $validation[$filed] = 'required|unique:catagories,name_cat|max:50';
        } 

        $validation_second = array('file' => 'required|max:10000|mimes:pdf,png,jpg'); 

        $allValidation =  array_merge($validation , $validation_second);

        return $allValidation;
        
    }
}
