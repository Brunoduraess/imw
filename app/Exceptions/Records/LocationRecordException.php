<?php

namespace App\Exceptions\Records;

use App\Exceptions\CustomHttpException;
use Throwable;

class LocationRecordException extends CustomHttpException
{
    public static function createFailed(Throwable $previous): self
    {
        return new self('Não foi possível criar o local.', previous: $previous);
    }

    public static function updateFailed(Throwable $previous): self
    {
        return new self('Não foi possível atualizar o local.', previous: $previous);
    }
}
