<?php

namespace App\Exceptions;

use Illuminate\Http\Response;
use Throwable;

class CustomHttpException extends AbstractCustomException
{
    public function __construct(
        string $message,
        int $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR,
        array $context = [],
        ?Throwable $previous = null
    ) {
        parent::__construct($message, $statusCode, $context, $previous);
    }
}
