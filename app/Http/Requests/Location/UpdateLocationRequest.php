<?php

namespace App\Http\Requests\Location;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLocationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nome' => ['required'],
            'rua' => ['required'],
            'numero' => ['required', 'integer'],
            'bairro' => ['required'],
            'cidade' => ['required'],
            'cep' => ['required'],
            'responsavel' => ['required'],
            'tel_responsavel' => ['required'],
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'O campo nome é obrigatório.',
            'rua.required' => 'O campo rua é obrigatório.',
            'numero.required' => 'O campo número é obrigatório.',
            'numero.integer' => 'O campo número deve ser um número inteiro.',
            'bairro.required' => 'O campo bairro é obrigatório.',
            'cidade.required' => 'O campo cidade é obrigatório.',
            'cep.required' => 'O campo CEP é obrigatório.',
            'responsavel.required' => 'O campo responsável é obrigatório.',
            'tel_responsavel.required' => 'O campo telefone do responsável é obrigatório.',
        ];
    }
}
