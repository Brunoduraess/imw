<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Event extends Model
{
    protected $keyType = 'string';

    public $incrementing = false;
    const CREATED_AT = 'criado_em';

    const UPDATED_AT = 'atualizado_em';

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'criado_por', 'id');
    }

    public function eventType()
    {
        return $this->belongsTo(EventType::class, 'tipo', 'id');
    }
}
