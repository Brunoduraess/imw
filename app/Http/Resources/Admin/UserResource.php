<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'email' => $this->email,
            'acesso' => $this->acesso,
            'status' => $this->status,
            'ultimo_acesso' => $this->ultimo_acesso?->format('d/m/Y H:i') ?? '-',
            'criado_em' => $this->criado_em->format('d/m/Y H:i'),
        ];
    }
}
