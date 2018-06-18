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

    /**
     * Sets $token protected Value.
     * @return  Token $token
     */
    protected function authenticate()
    {
        try {
            $headers     = ['headers' => ['X_CONSUMER_KEY' => $this->apiKey]];
            $response    = $this->client->get('token', $headers);
            $result      = json_decode($response->getBody()->getContents());
            $this->token = $result->token;

            return $result->token;
        } catch (RequestException $e) {
            $response = $this->statusCodeHandling($e);

            return $response;
        }
    }

    /**
     * Get The transaction details by the transaction id
     * @param  int $transactionId Monetizze Transaction Id
     * @return array                Result
     */
    public function getTransactionDetails($transactionId)
    {
        $token = $this->authenticate();
        if (!is_string($token)) {
            return $token;
        }

        try {
            $data = [
                'headers' => ['TOKEN' => $token],
            ];
            $response = $this->client->get("transactions?transaction=$transactionId", $data);

            return json_decode($response->getBody()->getContents());
        } catch (RequestException $e) {
            $response = $this->statusCodeHandling($e);

            return $response;
        }
    }

    /**
     * Get Transactions from Customer E-mail
     * @param  string $email The Customer E-mail Address
     * @return array        results
     */
    public function getTransactionsByEmail($email)
    {
        $token = $this->authenticate();
        if (!is_string($token)) {
            return $token;
        }

        try {
            $data = [
                'headers' => ['TOKEN' => $token],
            ];
            $response = $this->client->get("transactions?email=$email", $data);

            return json_decode($response->getBody()->getContents());
        } catch (RequestException $e) {
            $response = $this->statusCodeHandling($e);

            return $response;
        }
    }

    /**
     * Get The transactions by the product code
     *
     * @param  array $arrFilter Filters Options for search to see all filter options visit: http://api.monetizze.com.br/2.1/apidoc/#api-Geral-Transactions
     * @return \StdClass        Result of Filter
     */
    public function getTransactionsByAdvancedFilter(array $arrFilter)
    {
        $token = $this->authenticate();
        if (!is_string($token)) {
            return $token;
        }

        try {
            $filter = http_build_query($arrFilter);
            $data   = [
                'headers' => ['TOKEN' => $token],
            ];

            $response = $this->client->get("transactions?$filter", $data);

            return json_decode($response->getBody()->getContents());
        } catch (RequestException $e) {
            $response = $this->statusCodeHandling($e);

            return $response;
        }
    }

    /**
     * Add Tracking number of Correios Company to a Specific Transaction
     * @param int $transaction  The Monetizze Transaction Code
     * @param string $trackingCode The Correios Tracking Number
     */
    public function addCorreiosTrackingNumber($transaction, $trackingCode)
    {
        $token = $this->authenticate();
        if (!is_string($token)) {
            return $token;
        }

        try {
            $data = [
                'headers'     => ['TOKEN' => $token],
                'form_params' => ['data' => json_encode([['codLog' => 1, 'transaction' => $transaction, 'trackingCode' => $trackingCode]])],
            ];
            $response = $this->client->post('sales/tracking', $data);

            return json_decode($response->getBody()->getContents());
        } catch (RequestException $e) {
            $response = $this->statusCodeHandling($e);

            return $response;
        }
    }

    /**
     * Change the boleto due date
     * @param  int $transaction The Monetizze Transaction Code
     * @param  date $newDueDate  The New due date in Y-m-d format
     * @return result
     */
    public function changeBoletoDueDate($transaction, $newDueDate)
    {
        $token = $this->authenticate();
        if (!is_string($token)) {
            return $token;
        }

        // Now Lets Grab The Specific Transaction
        try {
            $data = [
                'headers'     => ['TOKEN' => $token],
                'form_params' => ['data' => json_encode(['transaction' => $transaction, 'data_vencimento' => $newDueDate])],
            ];
            $response = $this->client->post('boleto', $data);

            return json_decode($response->getBody()->getContents());
        } catch (RequestException $e) {
            $response = $this->statusCodeHandling($e);

            return $response;
        }
    }

    /**
     * Handle The Error
     * @param  Exception $e
     * @return array    Result
     */
    protected function statusCodeHandling($e)
    {
        $response = (object) [
            'status' => $e->getResponse()->getStatusCode(),
            'error'  => json_decode($e->getResponse()->getBody(true)->getContents())
        ];

        return $response;
    }
}
