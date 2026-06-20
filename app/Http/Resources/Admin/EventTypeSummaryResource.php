<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventTypeSummaryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'tipo' => $this->eventType->nome,
            'total' => $this->total,
        ];
    }
}
