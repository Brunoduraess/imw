<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Throwable;

abstract class AbstractCustomException extends Exception
{
    public function __construct(
        string $message,
        protected int $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR,
        protected array $context = [],
        ?Throwable $previous = null
    ) {
        parent::__construct($message, 0, $previous);
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function getContext(): array
    {
        return $this->context;
    }

    public function render(Request $request): JsonResponse|RedirectResponse
    {
        if ($request->expectsJson()) {
            return response()->json([
                'message' => $this->getMessage(),
            ], $this->statusCode);
        }

        return back()
            ->withInput()
            ->with('error', $this->getMessage());
    }
}
