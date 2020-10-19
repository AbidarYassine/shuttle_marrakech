<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DemandeRequest extends FormRequest
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
            "name" => 'required|string',
            "telephone" => 'required|string|max:20|min:9',
            "email" => 'required|email|max:100',
            "date_rdv" => 'required|date',
            "heure" => "required",
            "arriver" => 'required|string|max:100',
            "depart" => 'required|string|max:100|min:2',
            "service_choisit" => "required|string",
            "vehicule" => "required|numeric",
            'id' => 'exists:categories',
        ];
    }

    public function messages()
    {
        return [
            'id.exists' => 'Choisit une categorie qui vous convient',
            'depart.min' => 'Choisit Départ',
        ];
    }
}
