<?php

namespace App\Http\Controllers;

use App\Models\EventType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EventTypeController extends Controller
{
    public function eventsType()
    {
        $eventsType = EventType::orderBy('nome')->get();
        return view('admin.eventsType', ['eventsType' => $eventsType]);
    }

    public function createEventType()
    {
        return view('admin.createEventType');
    }

    public function createEventTypeSubmit(Request $request)
    {
        $request->validate(
            [
                'nome' => 'required',
                'descricao' => 'required',
                'duracao' => 'required|min:1|max:5'
            ],
            [
                'nome.required' => 'É obrigatório informar o nome do tipo de evento',
                'descricao.required' => 'É obrigatório informar uma descrição para o tipo de evento',
                'duracao.required' => 'Informe a duração do evento em dias',
                'duracao.min' => 'O evento deve ter duração de, no mínimo, 1 dia.',
                'duracao.max' => 'O evento deve ter duração de, no máximo, 10 dias.'
            ]
        );

        $eventType = new EventType();
        $eventType->id = (string) Str::uuid();
        $eventType->nome = $request->input('nome');
        $eventType->descricao = $request->input('descricao');
        $eventType->total_dias = $request->input('duracao');
        $eventType->save();
        return redirect()->route('eventsType')->with('success', 'Tipo de evento cadastrado com sucesso!');

    }

    public function editEventType($id)
    {
        $eventType = EventType::find($id);

        if (!$eventType) {
            return redirect()->route('eventsType')->with('error', 'Tipo de evento não encontrado.');
        }

        return view('admin.editEventType', ['eventType' => $eventType]);
    }

    public function editEventTypeSubmit(Request $request)
    {
        $request->validate(
            [
                'nome' => 'required',
                'descricao' => 'required',
                'duracao' => 'required|min:1|max:5'
            ],
            [
                'nome.required' => 'É obrigatório informar o nome do tipo de evento',
                'descricao.required' => 'É obrigatório informar uma descrição para o tipo de evento',
                'duracao.required' => 'Informe a duração do evento em dias',
                'duracao.min' => 'O evento deve ter duração de, no mínimo, 1 dia.',
                'duracao.max' => 'O evento deve ter duração de, no máximo, 10 dias.'
            ]
        );

        EventType::where('id', '=', $request->input('id'))
            ->update([
                'nome' => $request->input('nome'),
                'descricao' => $request->input('descricao'),
                'total_dias' => $request->input('duracao')
            ]);

        return redirect()->route('eventsType')->with('success', 'Tipo de evento editado com sucesso!');

    }
}
