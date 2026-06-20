<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LastAccessResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $nameParts = explode(' ', $this->nome);

        return [
            'nome' => $nameParts[0].' '.end($nameParts),
            'data_acesso' => $this->ultimo_acesso->format('d/m/Y H:i'),
        ];
    }
}
