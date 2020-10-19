<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategorieRequest extends FormRequest
{
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
     * @return array
     */
    public function rules()
    {
//        'designation', 'NbrPlaceMin', 'NbrPlaceMax', 'image'
        return [
            'designation' => 'required|string|max:30|unique:categories',
            'NbrPlaceMax' => 'required|numeric|min:1',
        ];
    }

    public function messages()
    {
        return [
            'designation.unique' => 'cette valeur est deja existe',
            'required' => 'ce champs est obligatoire',
            'numeric' => 'ce champs doit etre numeric',
            'min' => 'la valeur minumum est 1',
        ];
    }
}
