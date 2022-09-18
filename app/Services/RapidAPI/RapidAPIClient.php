<?php

namespace App\Services\RapidAPI;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Collection;

abstract class RapidAPIClient
{
    protected string $url;
    protected string $key;
    protected string $host;

    public function __construct() {
        $this->host = config('nasdaq.api_host');
        $this->key = config('nasdaq.api_key');
    }

    public function retrieveData ($companySymbol) : ?Collection {

        $client = new Client();
        try {
            $response = $client->get($this->url, [
                'headers' => [
                    'X-RapidAPI-Key' => $this->key,
                    'X-RapidAPI-Host' => $this->host
                ],
                'query' => [
                    'symbol' => $companySymbol
                ]
            ]);
            $bodyContent = $response->getBody()->getContents();
            $body = json_decode($bodyContent ?? '[]', true);
            return collect($body ? $body['prices'] : []);
        } catch (\Throwable $e) {
            return null;
        }
    }
}
