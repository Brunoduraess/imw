<?php

namespace App\Http\Controllers;

use App\Http\Requests\Location\StoreLocationRequest;
use App\Http\Requests\Location\UpdateLocationRequest;
use App\Services\LocationService;

class LocationController extends Controller
{
    public function __construct(
        private LocationService $locationService
    ) {}

    public function locations()
    {
        return view('admin.locations', ['locations' => $this->locationService->allFormatted()]);
    }

    public function createLocation()
    {
        return view('admin.createLocation');
    }

    public function createLocationSubmit(StoreLocationRequest $request)
    {
        $this->locationService->create($request->validated());

        return redirect()->route('locations')->with('success', 'Local criado com sucesso!');
    }

    public function editLocation(string $id)
    {
        return view('admin.editLocation', ['location' => $this->locationService->find($id)]);
    }

    public function editLocationSubmit(UpdateLocationRequest $request)
    {
        $this->locationService->update($request->validated());

        return redirect()->route('locations')->with('success', 'Local editado com sucesso!');
    }
}
