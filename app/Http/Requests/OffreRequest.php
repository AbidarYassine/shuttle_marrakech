<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OffreRequest extends FormRequest
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
        //        'depart', 'arriver', 'prix', 'categorie_id'
        return [
            'depart' => 'required|string|max:100',
            'arriver' => 'required|string|max:100',
            'prix_transfert' => 'required|numeric|max:10000000',
            'prix_aller_retour' => 'required|numeric|max:10000000',
            'prix_mise_disposition' => 'required|numeric|max:10000000',
            'soiré' => 'required|numeric|max:10000000',

        ];
    }

    // public function messages()
    // {
    //     return [
    //         'categorie_id.min' => 'Aucun Categorie choisit',
    //         'required' => 'ce champs est obligatoire',
    //         'prix.min' => 'prix eleve !!!'
    //     ];
    // }
}
