<?php

namespace Skaisser\Monetizze;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class ApiMonetizze
{
    const API_URL = 'https://api.monetizze.com.br/2.1/';

    protected $client;
    protected $apiKey;
    protected $token;

    /**
     * Constructor
     *
     * @param  string            $consumerKey  (optional) Chave para acesso a API
     */
    public function __construct($apiKey)
    {
        $this->client = new Client(['base_uri' => SELF::API_URL]);
        $this->apiKey = $apiKey;
    }

    protected function authenticate()
    {
        try {
            $headers = ['headers' => ['X_CONSUMER_KEY' => $this->apiKey]];
            $response = $this->client->get('token', $headers);
            $result = json_decode($response->getBody()->getContents());
            $this->token = $result->token;
            return $result->token;
        } catch (RequestException $e) {
            $response = $this->statusCodeHandling($e);
            return $response;
        }
    }

    public function getTransactionDetails($transactionId)
    {
        // First Lets Authenticate
        $token = $this->authenticate();
        // Now Lets Grab The Specific Transaction
        try {
            $data = [
                'headers' => ['TOKEN' => $token],
            ];
            $response = $this->client->get("transactiondetail?transaction_code=$transactionId", $data);
            return json_decode($response->getBody()->getContents());
        } catch (RequestException $e) {
            $response = $this->statusCodeHandling($e);
            return $response;
        }
    }

    protected function statusCodeHandling($e)
    {
        $response = [
            'statuscode' => $e->getResponse()->getStatusCode(),
            'error' => json_decode($e->getResponse()->getBody(true)->getContents())
        ];
        return $response;
    }
}
