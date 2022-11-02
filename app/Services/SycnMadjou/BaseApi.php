<?php

namespace App\Services\SycnMadjou;

use GuzzleHttp\Client;

abstract class BaseApi
{
    protected $api;
    public function __construct()
    {
        $this->api = new Client([
            'base_uri'  => '',
            'headers'   => [
                'Accept'        => 'application/json',
            ],
            'timeout'   => 10
        ]);
    }

    /**
     * Request to and endpoint
     *
     * @param string $method
     * @param string $endpoint
     * @param array $headers
     * @param array $params
     * @return object
     */
    protected function request(string $method, string $endpoint, array $params)
    {
        $response = $this->api->request($method, $endpoint, $params);

        return json_decode($response->getBody(), true);
    }
}
