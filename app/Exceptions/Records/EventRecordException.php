<?php

namespace App\Exceptions\Records;

use App\Exceptions\CustomHttpException;
use Throwable;

class EventRecordException extends CustomHttpException
{
    public static function createFailed(Throwable $previous): self
    {
        return new self('Não foi possível criar o evento.', previous: $previous);
    }

    public static function updateFailed(Throwable $previous): self
    {
        return new self('Não foi possível atualizar o evento.', previous: $previous);
    }

    public static function disableFailed(Throwable $previous): self
    {
        return new self('Não foi possível desativar o evento.', previous: $previous);
    }

    public static function enableFailed(Throwable $previous): self
    {
        return new self('Não foi possível ativar o evento.', previous: $previous);
    }
}
