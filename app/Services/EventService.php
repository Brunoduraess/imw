<?php

namespace App\Services;

use App\Models\Event;
use App\Models\EventType;
use App\Models\Location;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EventService
{
    public function getDashboardData(): array
    {
        $events = Event::with(['user', 'eventType'])->get();

        foreach ($events as $event) {
            $event->criado_por = $event->user->nome;
            $event->tipo = $event->eventType->nome;

            $nameParts = explode(' ', $event->criado_por);
            $event->criado_por = $nameParts[0].' '.end($nameParts);
            $event->inscricao = isset($event->inscricao) ? 'R$'.number_format($event->inscricao, 2, ',', '.') : '-';
            $event->data = date('d/m/Y', strtotime($event->data));
            $event->horario = date('H:i', strtotime($event->horario));
            $event->data_criacao = date('d/m/Y', strtotime($event->criado_em));
        }

        $eventsPerStatus = Event::selectRaw('count(id) as total, status')
            ->groupBy('status')
            ->get();

        $eventsPerType = Event::selectRaw('count(id) as total, tipo')
            ->groupBy('tipo')
            ->orderBy('total', 'desc')
            ->get();

        foreach ($eventsPerType as $eventPerType) {
            $eventPerType->tipo = $eventPerType->eventType->nome;
        }

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
    }

    public function getEditData(string $id): array
    {
        $locations = Location::orderBy('nome')->get();

        foreach ($locations as $location) {
            $location->id = (string) $location->id;
        }

        return [
            'event' => Event::find($id),
            'locations' => $locations,
            'eventTypes' => EventType::orderBy('nome')->get(),
        ];
    }

    public function update(array $data, string $userId): void
    {
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
    }

    public function disable(string $id, string $userId): void
    {
        Event::where('id', $id)->update([
            'status' => 'Inativo',
            'desativado_por' => $userId,
            'desativado_em' => now(),
        ]);
    }

    public function enable(string $id): void
    {
        Event::where('id', $id)->update([
            'status' => 'Ativo',
            'desativado_por' => null,
            'desativado_em' => null,
        ]);
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
