<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DemandeCauffeurRequest extends FormRequest
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
            'nom' => 'required|string|max:20',
            'prenom' => 'required|string|max:20',
            'address' => 'required|string|max:50',
            'email' => 'email|string|max:100|unique:chauffeurs',
            'password' => 'required_without:id|string|confirmed',
            'telephone' => ["required", "regex:/^(0|\+212)[1-9]([-.]?[0-9]{2}){4}$/", "unique:chauffeurs"],
            'numeroPermi' => 'required|string|max:30|unique:chauffeurs',
            'designation' => 'required|string|exists:categories',
            'model' => 'required|string|max:20',
            'matricule' => 'required|string|max:30',
            'marque' => 'required|string|max:20',
            'image.*' => 'required|image|mimes:jpg,png,jpeg',
        ];
    }
}
