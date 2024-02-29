<?php

declare(strict_types = 1);

namespace App\Api\BinPacking;

use App\Api\BinPacking\Request\FindBoxSizeRequest;
use App\Api\BinPacking\Response\FindBoxSizeResponse;
use App\Http\HttpClientFactory;
use GuzzleHttp\Client;
use JMS\Serializer\Serializer;

class BinPackingClient
{

    private const USERNAME = 'info@tblaha.cz';

    private const API_KEY = '00817b4f0b02187d2c82e855a4e4615f';

    private const FIND_BIN_SIZE_PATH = 'packer/findBinSize';

    private Client $client;

    private Serializer $serializer;

    public function __construct(
        HttpClientFactory $httpClientFactory,
        Serializer $serializer
    )
    {
        $this->client = $httpClientFactory->createClient('https://eu.api.3dbinpacking.com');
        $this->serializer = $serializer;
    }

    public function getMinimalBoxSize(
        FindBoxSizeRequest $findBoxSizeRequest
    ): FindBoxSizeResponse
    {
        $findBoxSizeRequestData = $this->composeRequestData(
            $this->serializer->toArray($findBoxSizeRequest)
        );


        $response = $this->client->post(self::FIND_BIN_SIZE_PATH, [
            'json' => $findBoxSizeRequestData,
        ]);


        /** @var FindBoxSizeResponse $findBoxSizeResponse */
        $findBoxSizeResponse = $this->serializer->deserialize(
            $response->getBody()->getContents(),
            FindBoxSizeResponse::class,
            'json'
        );

        return $findBoxSizeResponse;
    }

    /**
     * @param mixed[] $requestData
     * @return mixed[]
     */
    private function composeRequestData(array $requestData): array
    {
        return array_merge(
            $requestData,
            [
                'username' => self::USERNAME,
                'api_key' => self::API_KEY,
            ]
        );
    }

}
