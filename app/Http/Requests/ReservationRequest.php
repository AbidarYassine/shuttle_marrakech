<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
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
            "destination" => "required|numeric|min:-2",
            "type" => "required|string",
            "vehicule" => "required|numeric",
            "nombre_de_jour" => "numeric",
            'departA' => 'required_if:autre_dest,==,1|max:50',
            'arriverA' => 'required_if:autre_dest,==,1|max:50',
            "date_retour" => 'required_if:id_date_retour,==,1|after_or_equal:date_rdv',
        ];
    }

    public function messages()
    {
        return [
            'date_retour.after_or_equal' => 'Le champ date retour doit être une date postérieure ou égale au date départ',
            'destination.min' => 'Choisit une destination',
            'departA.required_if' => 'Le champ depart  est obligatoire',
            'arriverA.required_if' => 'Le champ arriver  est obligatoire',

        ];

    }
}
