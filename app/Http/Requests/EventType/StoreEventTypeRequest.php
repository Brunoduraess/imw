<?php

namespace App\Http\Requests\EventType;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventTypeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nome' => ['required'],
            'descricao' => ['required'],
            'duracao' => ['required', 'min:1', 'max:5'],
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'É obrigatório informar o nome do tipo de evento',
            'descricao.required' => 'É obrigatório informar uma descrição para o tipo de evento',
            'duracao.required' => 'Informe a duração do evento em dias',
            'duracao.min' => 'O evento deve ter duração de, no mínimo, 1 dia.',
            'duracao.max' => 'O evento deve ter duração de, no máximo, 10 dias.',
        ];
    }
}
