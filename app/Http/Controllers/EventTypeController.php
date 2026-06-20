<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventType\StoreEventTypeRequest;
use App\Http\Requests\EventType\UpdateEventTypeRequest;
use App\Models\EventType;
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

    public function createEventTypeSubmit(StoreEventTypeRequest $request)
    {
        $eventType = new EventType;
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

        if (! $eventType) {
            return redirect()->route('eventsType')->with('error', 'Tipo de evento não encontrado.');
        }

        return view('admin.editEventType', ['eventType' => $eventType]);
    }

    public function editEventTypeSubmit(UpdateEventTypeRequest $request)
    {
        EventType::where('id', '=', $request->input('id'))
            ->update([
                'nome' => $request->input('nome'),
                'descricao' => $request->input('descricao'),
                'total_dias' => $request->input('duracao'),
            ]);

        return redirect()->route('eventsType')->with('success', 'Tipo de evento editado com sucesso!');

    }
}
