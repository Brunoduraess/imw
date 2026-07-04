<?php

namespace App\Services;

use App\Exceptions\Records\LocationRecordException;
use App\Http\Resources\Admin\LocationResource;
use App\Models\Location;
use Illuminate\Support\Str;
use Throwable;

class LocationService
{
    public function allFormatted(): array
    {
        return LocationResource::collection(Location::orderBy('nome')->get())->resolve();
    }

    public function create(array $data): Location
    {
        try {
            return Location::create([
                'id' => (string) Str::uuid(),
                ...$this->attributes($data),
                'complemento' => $data['complemento'] ?? '',
            ]);
        } catch (Throwable $exception) {
            throw LocationRecordException::createFailed($exception);
        }
    }

    public function find(string $id): ?Location
    {
        return Location::find($id);
    }

    public function update(array $data): void
    {
        try {
            Location::whereKey($data['id'])->update($this->attributes($data, true));
        } catch (Throwable $exception) {
            throw LocationRecordException::updateFailed($exception);
        }
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
