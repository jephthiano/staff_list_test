<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class CustomApiException extends Exception
{
    protected int $status;
    protected array $errorData;

    public function __construct(string $message = "An error occurred", int $status = 400, array $errorData = [])
    {
        parent::__construct($message);
        $this->status = $status;
        $this->errorData = $errorData;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function getErrorData(): array
    {
        return $this->errorData;
    }
}