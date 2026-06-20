<?php

namespace App\Http\Requests\Event;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEventRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nome' => ['required', 'min:10'],
            'tipo' => ['required'],
            'descricao' => ['required', 'min:20'],
            'data' => ['required'],
            'horario' => ['required'],
            'local' => ['required'],
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'É necessário informar o nome do evento. Ex: Culto de adoração',
            'nome.min' => 'O nome do evento deve possuir no mínimo 10 caracteres',
            'tipo.required' => 'É necessário informar o tipo de evento',
            'descricao.required' => 'É necessário informar uma descrição para o evento',
            'descricao.min' => 'A descrição deve possuir no mínimo 20 caracteres',
            'data.required' => 'É necessário informar a data do evento',
            'horario.required' => 'É necessário informar o horário do evento',
            'local.required' => 'É necessário informar o local do evento',
        ];
    }
}
