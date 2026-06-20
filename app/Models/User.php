<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $keyType = 'string';

    public $incrementing = false;

    const CREATED_AT = 'criado_em';

    const UPDATED_AT = 'atualizado_em';

    protected $hidden = [
        'senha',
    ];

    protected function casts(): array
    {
        return [
            'ultimo_acesso' => 'datetime',
            'desativado_em' => 'datetime',
        ];
    }

    public function getAuthPasswordName(): string
    {
        return 'senha';
    }

    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }
}
