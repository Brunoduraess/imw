<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $creatorName = $this->user->nome;
        $nameParts = explode(' ', $creatorName);

        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'descricao' => $this->descricao,
            'tipo' => $this->eventType->nome,
            'data' => date('d/m/Y', strtotime($this->data)),
            'horario' => date('H:i', strtotime($this->horario)),
            'inscricao' => isset($this->inscricao) ? 'R$'.number_format($this->inscricao, 2, ',', '.') : '-',
            'status' => $this->status,
            'criado_por' => $nameParts[0].' '.end($nameParts),
            'criado_em' => date('d/m/Y', strtotime($this->criado_em)),
        ];
    }
}
