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
        return Location::create([
            'id' => (string) Str::uuid(),
            ...$this->attributes($data),
            'complemento' => $data['complemento'] ?? '',
        ]);
    }

    public function find(string $id): ?Location
    {
        return Location::find($id);
    }

    public function update(array $data): void
    {
        Location::whereKey($data['id'])->update($this->attributes($data, true));
    }

    private function attributes(array $data, bool $removeDots = false): array
    {
        $phoneCharacters = $removeDots ? ['-', '(', ')', ' ', '.'] : ['-', '(', ')', ' '];

        return [
            'nome' => $data['nome'],
            'rua' => $data['rua'],
            'numero' => $data['numero'],
            'bairro' => $data['bairro'],
            'cidade' => $data['cidade'],
            'cep' => str_replace('-', '', $data['cep']),
            'responsavel' => $data['responsavel'],
            'tel_responsavel' => str_replace($phoneCharacters, '', $data['tel_responsavel']),
        ];
    }
}
