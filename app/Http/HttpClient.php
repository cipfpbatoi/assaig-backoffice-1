<?php

namespace App\Http;

use GuzzleHttp\Client;
class HttpClient
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function get($url, $headers = [])
    {
        $response = $this->client->request('GET', $url, [
            'headers' => $headers,
        ]);

        return $response->getBody()->getContents();
    }

    // Añadir otros métodos para enviar otras solicitudes HTTP como POST, PUT, DELETE, etc.
}

