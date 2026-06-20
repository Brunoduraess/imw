<?php

namespace App\Services;

use App\Models\EventType;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;

class EventTypeService
{
    public function all(): Collection
    {
        return EventType::orderBy('nome')->get();
    }

    public function create(array $data): EventType
    {
        return EventType::create([
            'id' => (string) Str::uuid(),
            'nome' => $data['nome'],
            'descricao' => $data['descricao'],
            'total_dias' => $data['duracao'],
        ]);
    }

    public function find(string $id): ?EventType
    {
        return EventType::find($id);
    }

    public function update(array $data): void
    {
        EventType::where('id', $data['id'])->update([
            'nome' => $data['nome'],
            'descricao' => $data['descricao'],
            'total_dias' => $data['duracao'],
        ]);
    }
}
