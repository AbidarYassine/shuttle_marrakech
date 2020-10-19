<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VehiculeRequest extends FormRequest
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
        //        'matricule', 'model', 'marque', 'chauffeur_id',
        return [
            'matricule' => 'required|string|max:30|unique:vehicules',
            'model' => 'required|string|max:50',
            'marque' => 'required|string|max:50',
            'categorie_id' => 'required|numeric|min:1',
            'chauffeur_id' => 'required|numeric|min:1',
            'nombre_valise' => 'required|numeric|min:1',
//            'prix_transfert' => 'required|numeric',
//            'prix_aller_retour' => 'required|numeric',
//            'prix_mise_disposition' => 'required|numeric',
//            'soiré' => 'required|numeric',
            'image.*' => 'required|image|mimes:jpg,jpeg,png',

        ];
    }

    public function messages()
    {
        return [
            'matricule.unique' => 'ce mmatricule esst deja existe',
            'required' => 'ce champ est obligatoire',
            'string' => 'ce champ doit être une chaîne de caractères',
            'max' => 'vous depasser le nombre maximum de caractères',
            'categorie_id.min' => 'choisit une categorie',
            'chauffeur_id.min' => 'choisit un chauffeur',
            'image.*' => 'ce chams doit être une image '
        ];
    }
}
