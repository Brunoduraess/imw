<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventType extends Model
{
    protected $table = 'event_types';

    protected $primaryKey = 'id';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'nome',
        'descricao',
        'total_dias',
    ];

    public function events()
    {
        return $this->hasMany(Event::class, 'tipo', 'id');
    }
}
