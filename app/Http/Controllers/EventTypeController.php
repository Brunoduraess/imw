<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventType\StoreEventTypeRequest;
use App\Http\Requests\EventType\UpdateEventTypeRequest;
use App\Services\EventTypeService;

class EventTypeController extends Controller
{
    public function __construct(
        private EventTypeService $eventTypeService
    ) {}

    public function eventsType()
    {
        return view('admin.eventsType', ['eventsType' => $this->eventTypeService->all()]);
    }

    public function createEventType()
    {
        return view('admin.createEventType');
    }

    public function createEventTypeSubmit(StoreEventTypeRequest $request)
    {
        $this->eventTypeService->create($request->validated());

        return redirect()->route('eventsType')->with('success', 'Tipo de evento cadastrado com sucesso!');
    }

    public function editEventType(string $id)
    {
        $eventType = $this->eventTypeService->find($id);

        if (! $eventType) {
            return redirect()->route('eventsType')->with('error', 'Tipo de evento não encontrado.');
        }

        return view('admin.editEventType', ['eventType' => $eventType]);
    }

    public function editEventTypeSubmit(UpdateEventTypeRequest $request)
    {
        $this->eventTypeService->update($request->validated());

        return redirect()->route('eventsType')->with('success', 'Tipo de evento editado com sucesso!');
    }
}
