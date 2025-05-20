<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventType extends Model
{
    protected $table = 'event_types';

    protected $primaryKey = 'id';
    
    public $incrementing = false;

    public function events()
    {
        return $this->hasMany(Event::class, 'tipo', 'id');
    }

}
