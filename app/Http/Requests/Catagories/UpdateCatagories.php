<?php

namespace App\Http\Requests\Catagories;

use Illuminate\Foundation\Http\FormRequest;

use App\Traits\LanguagesTrait;


class UpdateCatagories extends FormRequest
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
            'file'                                =>   'required|max:10000|mimes:pdf,png,jpg',
            $this->GetValidInputLang('name_cat')  =>   'required'
        ];
    }
}
