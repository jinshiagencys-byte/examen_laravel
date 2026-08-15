<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReturnEmpruntRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user() !== null && $this->user()->statut === 'active';
    }

    public function rules()
    {
        return [
            'date_effective_retour' => ['required', 'date'],
        ];
    }
}
