<?php

namespace App\Http\Requests\Main;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nome' => ['required', 'string', 'max:100'],
            'telefone' => ['required', 'string', 'max:15'],
            'email' => ['required', 'email', 'max:100'],
            'assunto' => ['required', 'string'],
            'mensagem' => ['required', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'O campo nome é obrigatório.',
            'telefone.required' => 'O campo telefone é obrigatório.',
            'email.required' => 'O campo email é obrigatório.',
            'assunto.required' => 'O campo assunto é obrigatório.',
            'mensagem.required' => 'O campo mensagem é obrigatório.',
        ];
    }
}
