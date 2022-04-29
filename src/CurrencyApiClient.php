<?php

namespace CurrencyApi\CurrencyApi;

use Exception;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

/**
 * Exposes the CurrencyAPI library to client code.
 */
class CurrencyApiClient
{
    const BASE_URL = 'https://api.currencyapi.com/v3/';
    const REQUEST_TIMEOUT_DEFAULT = 15; // seconds

    protected Client $httpClient;

    public function __construct(public string $apiKey, ?array $settings = [])
    {
        $guzzle_opts = [
            'http_errors' => false,
            'headers' => $this->buildHeaders($apiKey),
            'timeout' => $settings['timeout'] ?? self::REQUEST_TIMEOUT_DEFAULT
        ];
        if (isset($settings['guzzle_opts'])) {
            $guzzle_opts = array_merge($guzzle_opts, $settings['guzzle_opts']);
        }
        $this->httpClient = new Client($guzzle_opts);
    }

    /**
     * @throws CurrencyApiException
     */
    private function call(string $endpoint, ?array $query = [])
    {
        $url = self::BASE_URL . $endpoint;

        try {
            $response = $this->httpClient->request('GET', $url, [
                'query' => $query
            ]);
        } catch (GuzzleException $e) {
            throw new CurrencyApiException($e->getMessage());
        } catch (Exception $e) {
            throw new CurrencyApiException($e->getMessage());
        }

        return json_decode($response->getBody(), true);
    }

    /**
     * @throws CurrencyApiException
     */
    public function status()
    {
        return $this->call('status');
    }

    /**
     * @throws CurrencyApiException
     */
    public function latest(?array $query = [])
    {
        return $this->call('latest', $query);
    }

    /**
     * @throws CurrencyApiException
     */
    public function historical($query)
    {
        return $this->call('historical', $query);
    }

    /**
     * @throws CurrencyApiException
     */
    public function convert($query)
    {
        return $this->call('convert', $query);
    }

    /**
     * @throws CurrencyApiException
     */
    public function range($query)
    {
        return $this->call('range', $query);
    }

    /**
     * Build headers for API request.
     * @return array Headers for API request.
     */
    private function buildHeaders($apiKey)
    {
        return [
            'user-agent' => 'CurrencyApi/PHP/0.1',
            'accept' => 'application/json',
            'content-type' => 'application/json',
            'apikey' => $apiKey,
        ];
    }
}
