<?php

namespace App\Services;

use App\Exceptions\Records\EventRecordException;
use App\Http\Resources\Admin\EventResource;
use App\Http\Resources\Admin\EventTypeSummaryResource;
use App\Models\Event;
use App\Models\EventType;
use App\Models\Location;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Throwable;

class EventService
{
    public function getDashboardData(): array
    {
        $events = EventResource::collection(
            Event::with(['user', 'eventType'])->get()
        )->resolve();

        $eventsPerStatus = Event::selectRaw('count(id) as total, status')
            ->groupBy('status')
            ->get();

        $eventsPerType = EventTypeSummaryResource::collection(
            Event::with('eventType')
                ->selectRaw('count(id) as total, tipo')
                ->groupBy('tipo')
                ->orderBy('total', 'desc')
                ->get()
        )->resolve();

        $eventPerLocation = Event::selectRaw('locations.nome as nome, count(events.id) as total')
            ->join('locations', 'events.local_id', '=', 'locations.id')
            ->groupBy('locations.id', 'locations.nome')
            ->orderBy('locations.id')
            ->get();

        return compact('events', 'eventsPerStatus', 'eventsPerType', 'eventPerLocation');
    }

    public function getCreateData(): array
    {
        return [
            'locations' => Location::orderBy('nome')->get(),
            'types' => EventType::orderBy('nome')->get(),
        ];
    }

    public function create(array $data, string $userId): Event
    {
        try {
            $id = (string) Str::uuid();

            return Event::create([
                'id' => $id,
                'nome' => $data['nome'],
                'descricao' => $data['descricao'],
                'tipo' => $this->eventTypeId($data['tipo']),
                'data' => $data['data'],
                'horario' => $data['horario'],
                'local_id' => $data['local'],
                'inscricao' => $this->formatPrice($data['valor'] ?? null),
                'imagem_agenda' => Storage::disk('public')->put("uploads/events/$id/imagem_agenda", $data['imagem_agenda']),
                'imagem_detalhe' => Storage::disk('public')->put("uploads/events/$id/imagem_detalhe", $data['imagem_detalhe']),
                'status' => 'Ativo',
                'criado_em' => now(),
                'criado_por' => $userId,
            ]);
        } catch (Throwable $exception) {
            throw EventRecordException::createFailed($exception);
        }
    }

    public function getEditData(string $id): array
    {
        return [
            'event' => Event::find($id),
            'locations' => Location::orderBy('nome')->get(),
            'eventTypes' => EventType::orderBy('nome')->get(),
        ];
    }

    public function update(array $data, string $userId): void
    {
        try {
            $id = $data['id'];
            $attributes = [
                'nome' => $data['nome'],
                'descricao' => $data['descricao'],
                'tipo' => $this->eventTypeId($data['tipo']),
                'data' => $data['data'],
                'horario' => $data['horario'],
                'local_id' => $data['local'],
                'inscricao' => $this->formatPrice($data['valor'] ?? null),
                'atualizado_em' => now(),
                'atualizado_por' => $userId,
            ];

            if (! empty($data['imagem_agenda'])) {
                $attributes['imagem_agenda'] = Storage::disk('public')->put("uploads/events/$id/imagem_agenda", $data['imagem_agenda']);
            }

            if (! empty($data['imagem_detalhe'])) {
                $attributes['imagem_detalhe'] = Storage::disk('public')->put("uploads/events/$id/imagem_detalhe", $data['imagem_detalhe']);
            }

            Event::where('id', $id)->update($attributes);
        } catch (Throwable $exception) {
            throw EventRecordException::updateFailed($exception);
        }
    }

    public function disable(string $id, string $userId): void
    {
        try {
            Event::where('id', $id)->update([
                'status' => 'Inativo',
                'desativado_por' => $userId,
                'desativado_em' => now(),
            ]);
        } catch (Throwable $exception) {
            throw EventRecordException::disableFailed($exception);
        }
    }

    public function enable(string $id): void
    {
        try {
            Event::where('id', $id)->update([
                'status' => 'Ativo',
                'desativado_por' => null,
                'desativado_em' => null,
            ]);
        } catch (Throwable $exception) {
            throw EventRecordException::enableFailed($exception);
        }
    }

    private function eventTypeId(string $type): string
    {
        return explode(' / ', $type)[0];
    }

    private function formatPrice(?string $price): ?string
    {
        if ($price === null) {
            return null;
        }

        return str_replace(',', '.', str_replace('.', '', $price));
    }
}
