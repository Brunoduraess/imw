<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LocationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'endereco' => $this->rua.', '.$this->numero.', '.$this->bairro.', '.$this->cidade,
            'cep' => preg_replace('/^(\d{5})(\d{3})$/', '$1-$2', $this->cep),
            'responsavel' => $this->responsavel,
            'tel_responsavel' => preg_replace('/(\d{2})(\d{5})(\d{4})/', '($1) $2-$3', $this->tel_responsavel),
        ];
    }
}
