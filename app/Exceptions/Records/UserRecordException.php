<?php

namespace App\Exceptions\Records;

use App\Exceptions\CustomHttpException;
use Throwable;

class UserRecordException extends CustomHttpException
{
    public static function createFailed(Throwable $previous): self
    {
        return new self('Não foi possível criar o usuário.', previous: $previous);
    }

    public static function updateFailed(Throwable $previous): self
    {
        return new self('Não foi possível atualizar o usuário.', previous: $previous);
    }

    public static function disableFailed(Throwable $previous): self
    {
        return new self('Não foi possível desativar o usuário.', previous: $previous);
    }

    public static function enableFailed(Throwable $previous): self
    {
        return new self('Não foi possível ativar o usuário.', previous: $previous);
    }

    public static function updateLastAccessFailed(Throwable $previous): self
    {
        return new self('Não foi possível atualizar o último acesso do usuário.', previous: $previous);
    }

    public static function updatePasswordFailed(Throwable $previous): self
    {
        return new self('Não foi possível atualizar a senha do usuário.', previous: $previous);
    }
}
