<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;

use App\Traits\LanguagesTrait;

class StoreProductsRequest extends FormRequest
{

    // Last Language
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
        return [
            $this->GetValidInputLang('name_pro')                 =>   'required|unique:products,name_product|max:50',
            $this->GetValidInputLang('des_pro')                  =>   'required',
            'number_pro'                                         =>   'required',
            'file'                                               =>   'required|max:10000|mimes:pdf,png,jpg',
        ];
    }
}
