<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmpruntRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user() !== null && $this->user()->statut === 'active';
    }

    public function rules()
    {
        return [
            'materiel_id' => ['required', 'uuid', 'exists:materiels,id'],
            'date_emprunt' => ['required', 'date'],
            'date_prevue_retour' => ['required', 'date', 'after_or_equal:date_emprunt'],
        ];
    }
}
