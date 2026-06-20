<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Location extends Model
{
    protected $keyType = 'string';

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'id',
        'nome',
        'responsavel',
        'tel_responsavel',
        'cep',
        'rua',
        'numero',
        'bairro',
        'cidade',
        'complemento',
    ];

    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }
}
