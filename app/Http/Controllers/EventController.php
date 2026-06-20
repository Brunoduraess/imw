<?php

namespace App\Http\Controllers;

use App\Http\Requests\Event\StoreEventRequest;
use App\Http\Requests\Event\UpdateEventRequest;
use App\Services\EventService;

class EventController extends Controller
{
    public function __construct(
        private EventService $eventService
    ) {}

    public function eventsAdmin()
    {
        return view('admin.events', $this->eventService->getDashboardData());
    }

    public function createEvent()
    {
        return view('admin.createEvent', $this->eventService->getCreateData());
    }

    public function createEventSubmit(StoreEventRequest $request)
    {
        $this->eventService->create($request->validated(), (string) auth()->id());

        return redirect()->route('eventsAdmin');
    }

    public function editEvent(string $id)
    {
        return view('admin.editEvent', $this->eventService->getEditData($id));
    }

    public function editEventSubmit(UpdateEventRequest $request)
    {
        $this->eventService->update($request->validated(), (string) auth()->id());

        return redirect()->route('eventsAdmin');
    }

    public function disableEvent(string $id)
    {
        $this->eventService->disable($id, (string) auth()->id());

        return redirect()->route('eventsAdmin');
    }

    public function enableEvent(string $id)
    {
        $this->eventService->enable($id);

        return redirect()->route('eventsAdmin');
    }
}
