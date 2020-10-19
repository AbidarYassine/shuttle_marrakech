<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FindRequest extends FormRequest
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
        return [
            'depart' => 'required|min:1',
            'arriver' => 'required|min:1',
        ];
    }

    public function messages()
    {
        return [
            'depart.min' => 'Choisit une point de départ',
            'arriver.min' => 'Choisit une point d\'arrivée',
        ];
    }
}
