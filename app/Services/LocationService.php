<?php

namespace App\Services;

use App\Models\Location;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;

class LocationService
{
    public function allFormatted(): Collection
    {
        $locations = Location::orderBy('nome')->get();

        foreach ($locations as $location) {
            $location->endereco = $location->rua.', '.$location->numero.', '.$location->bairro.', '.$location->cidade;
            $location->cep = preg_replace('/^(\d{5})(\d{3})$/', '$1-$2', $location->cep);
            $location->tel_responsavel = preg_replace('/(\d{2})(\d{5})(\d{4})/', '($1) $2-$3', $location->tel_responsavel);
        }

        return $locations;
    }

    public function create(array $data): Location
    {
        $location = new Location;
        $location->id = (string) Str::uuid();
        $this->fill($location, $data);
        $location->save();

        return $location;
    }

    public function find(string $id): ?Location
    {
        return Location::find($id);
    }

    public function update(array $data): void
    {
        $location = Location::find($data['id']);
        $this->fill($location, $data, true);
        $location->save();
    }

    private function fill(Location $location, array $data, bool $removeDots = false): void
    {
        $phoneCharacters = $removeDots ? ['-', '(', ')', ' ', '.'] : ['-', '(', ')', ' '];

        $location->nome = $data['nome'];
        $location->rua = $data['rua'];
        $location->numero = $data['numero'];
        $location->bairro = $data['bairro'];
        $location->cidade = $data['cidade'];
        $location->cep = str_replace('-', '', $data['cep']);
        $location->responsavel = $data['responsavel'];
        $location->tel_responsavel = str_replace($phoneCharacters, '', $data['tel_responsavel']);
    }
}
