<?php

namespace WeWork\Http;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\StreamInterface;

class HttpClient implements HttpClientInterface
{
    /**
     * @var Client
     */
    private Client $client;

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $uri
     * @param array $query
     * @return array
     * @throws GuzzleException
     */
    public function get(string $uri, array $query = []): array
    {
        return $this->client->get($uri, compact('query'))->toArray();
    }

    /**
     * @param string $uri
     * @param array $query
     * @return StreamInterface
     * @throws GuzzleException
     */
    public function getStream(string $uri, array $query = []): StreamInterface
    {
        return $this->client->get($uri, compact('query'))->getBody();
    }

    /**
     * @param string $uri
     * @param array $json
     * @param array $query
     * @return array
     * @throws GuzzleException
     */
    public function postJson(string $uri, array $json = [], array $query = []): array
    {
        return $this->client->post($uri, compact('json', 'query'))->toArray();
    }

    /**
     * @param string $uri
     * @param string $path
     * @param array $query
     * @return array
     * @throws GuzzleException
     */
    public function postFile(string $uri, string $path, array $query = []): array
    {
        return $this->client->post($uri, array_merge([
            'multipart' => [
                [
                    'name' => 'media',
                    'contents' => fopen($path, 'r')
                ]
            ]
        ], compact('query')))->toArray();
    }
}
