<?php

namespace App\Exceptions\Records;

use App\Exceptions\CustomHttpException;
use Throwable;

class EventTypeRecordException extends CustomHttpException
{
    public static function createFailed(Throwable $previous): self
    {
        return new self('Não foi possível criar o tipo de evento.', previous: $previous);
    }

    public static function updateFailed(Throwable $previous): self
    {
        return new self('Não foi possível atualizar o tipo de evento.', previous: $previous);
    }
}
