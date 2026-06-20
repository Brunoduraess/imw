<?php

namespace App\Http\Controllers;

use App\Http\Requests\Location\StoreLocationRequest;
use App\Http\Requests\Location\UpdateLocationRequest;
use App\Models\Location;
use Illuminate\Support\Str;

class LocationController extends Controller
{
    public function locations()
    {
        $locations = Location::orderBy('nome')->get();

        foreach ($locations as $location) {
            $location->endereco = $location->rua.', '.$location->numero.', '.$location->bairro.', '.$location->cidade;
            $location->cep = preg_replace('/^(\d{5})(\d{3})$/', '$1-$2', $location->cep);
            $location->tel_responsavel = preg_replace('/(\d{2})(\d{5})(\d{4})/', '($1) $2-$3', $location->tel_responsavel);
        }

        return view('admin.locations', ['locations' => $locations]);

    }

    public function createLocation()
    {
        return view('admin.createLocation');
    }

    public function createLocationSubmit(StoreLocationRequest $request)
    {
        $location = new Location;
        $location->id = (string) Str::uuid();
        $location->nome = $request->input('nome');
        $location->rua = $request->input('rua');
        $location->numero = $request->input('numero');
        $location->bairro = $request->input('bairro');
        $location->cidade = $request->input('cidade');
        $location->cep = str_replace('-', '', $request->input('cep'));
        $location->responsavel = $request->input('responsavel');
        $location->tel_responsavel = str_replace(['-', '(', ')', ' '], '', $request->input('tel_responsavel'));
        $location->save();

        return redirect()->route('locations')->with('success', 'Local criado com sucesso!');
    }

    public function editLocation($id)
    {
        $location = Location::find($id);

        return view('admin.editLocation', ['location' => $location]);
    }

    public function editLocationSubmit(UpdateLocationRequest $request)
    {
        Location::where('id', '=', $request->input('id'))
            ->update([
                'nome' => $request->input('nome'),
                'rua' => $request->input('rua'),
                'numero' => $request->input('numero'),
                'bairro' => $request->input('bairro'),
                'cidade' => $request->input('cidade'),
                'cep' => str_replace('-', '', $request->input('cep')),
                'responsavel' => $request->input('responsavel'),
                'tel_responsavel' => str_replace(['-', '(', ')', ' ', '.'], '', $request->input('tel_responsavel')),
            ]);

        return redirect()->route('locations')->with('success', 'Local editado com sucesso!');
    }
}
