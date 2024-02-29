<?php

declare(strict_types = 1);

namespace App\Http;

use GuzzleHttp\Client;

class HttpClientFactory
{

    public function createClient(string $baseUri): Client
    {
        return new Client([
            'base_uri' => $baseUri,
        ]);
    }

}
