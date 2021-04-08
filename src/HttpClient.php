<?php

namespace ForwardForce\TeleVoIPs;

use ForwardForce\TeleVoIPs\Traits\Pagable;
use ForwardForce\TeleVoIPs\Traits\Parametarable;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

class HttpClient
{
    use Pagable;
    use Parametarable;

    protected string $baseURL = 'https://api.televoips.com';

    /**
     * Guzzle Client
     *
     * @var Client
     */
    protected Client $client;

    /**
     * The API response
     *
     * @var ResponseInterface
     */
    protected ResponseInterface $response;

    /**
     * If there is next page
     *
     * @var bool
     */
    protected bool $hasMore;

    /**
     * Num of results returned by the API call
     *
     * @var int
     */
    private int $found;

    public function __construct(string $apiKey)
    {
        $this->client = new Client(['base_uri' => $this->baseURL, 'headers', ['Authorization', $apiKey]]);
    }

    /**
     * Send get request
     *
     * @param  string $endpoint
     * @return array
     * @throws GuzzleException
     */
    public function get(string $endpoint): array
    {
        $this->response = $this->client->get($endpoint);
        return $this->toArray();
    }

    public function post(string $endpoint): array
    {
        $this->response = $this->client->post($endpoint, ['form_params' => $this->getBodyParams()]);
        return $this->toArray();
    }

    /**
     * Num of results returned by the API call
     *
     * @return int
     */
    public function count(): int
    {
        return $this->found;
    }

    /**
     * Parse response
     *
     * @return array
     */
    private function toArray(): array
    {
        $response = json_decode($this->response->getBody()->getContents(), true);

        if (empty($response)) {
            return [];
        }

        $this->hasMore = $response['has_more'];
        $this->found = $response['found'];
        return $response['data'];
    }

    /**
     * Add query parameters to endpoint
     *
     * @param  string $endpoint
     * @return string
     */
    protected function buildQuery(string $endpoint): string
    {

        if (empty($this->getQueryString())) {
            return $endpoint;
        }

        return $endpoint . '?' . http_build_query($this->getQueryString());
    }
}
