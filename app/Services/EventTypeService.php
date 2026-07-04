<?php

namespace App\Services;

use App\Exceptions\Records\EventTypeRecordException;
use App\Models\EventType;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;
use Throwable;

class EventTypeService
{
    public function all(): Collection
    {
        return EventType::orderBy('nome')->get();
    }

    public function create(array $data): EventType
    {
        try {
            return EventType::create([
                'id' => (string) Str::uuid(),
                'nome' => $data['nome'],
                'descricao' => $data['descricao'],
                'total_dias' => $data['duracao'],
            ]);
        } catch (Throwable $exception) {
            throw EventTypeRecordException::createFailed($exception);
        }
    }

    public function find(string $id): ?EventType
    {
        return EventType::find($id);
    }

    public function update(array $data): void
    {
        try {
            EventType::where('id', $data['id'])->update([
                'nome' => $data['nome'],
                'descricao' => $data['descricao'],
                'total_dias' => $data['duracao'],
            ]);
        } catch (Throwable $exception) {
            throw EventTypeRecordException::updateFailed($exception);
        }
    }
}
