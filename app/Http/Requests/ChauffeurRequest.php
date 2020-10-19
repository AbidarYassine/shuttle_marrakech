<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChauffeurRequest extends FormRequest
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
//        'nom', 'prenom', 'email', 'password','address', 'active', 'telephone', 'typePermi', 'categorie_id', 'numeroPermi'
        return [
            'nom' => 'required|string|max:20',
            'prenom' => 'required|string|max:20',
            'address' => 'required|string|max:50',
            'telephone' => ["required", "regex:/^(0|\+212)[1-9]([-.]?[0-9]{2}){4}$/", "unique:chauffeurs"],
            'numeroPermi' => 'required|string|max:30|unique:chauffeurs',
            'id' => 'required|numeric|exists:categories',
            'image.*' => 'image|mimes:jpg,jpeg,png,gif',
//            'password' => 'required_with:email',
//            'email' => 'required_with:password',
            'password' => 'required|string',
            'email' => 'required|email'
        ];
    }

//    public function messages()
//    {
//        return [
//            'required' => 'ce champs est obligatoire',
//            'string' => 'ce champs doit être une chaîne de caractères',
//            'max' => 'la taille est grand',
//            'telephone.regex' => 'le format incorrect',
//            'numeroPermi.unique' => 'le numéro permi déja existe',
//            'typePermi.min' => 'choisit une type',
//            'categorie_id.min' => 'choisit une categorie',
//        ];
//    }
}
