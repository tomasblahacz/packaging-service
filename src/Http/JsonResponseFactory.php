<?php

declare(strict_types = 1);

namespace App\Http;

use GuzzleHttp\Psr7\Response;
use Throwable;

class JsonResponseFactory
{

    public function create(
        int $httpCode,
        string $body
    ): Response
    {
        return new Response(
            $httpCode,
            [
                'Content-Type' => 'application/json',
            ],
            $body,
        );
    }

    public function createError(
        int $httpCode,
        Throwable $throwable
    ): Response
    {
        return $this->createErrorFromMessage($httpCode, $throwable->getMessage());
    }

    public function createErrorFromMessage(
        int $httpCode,
        string $message
    ): Response
    {
        return new Response(
            $httpCode,
            [
                'Content-Type' => 'application/json',
            ],
            $message
        );
    }

}
