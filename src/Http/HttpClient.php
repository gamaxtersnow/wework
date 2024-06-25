<?php

namespace WeWork\Http;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Promise\Promise;
use GuzzleHttp\Promise\Utils;
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
     * @param bool $stream
     * @return StreamInterface
     * @throws GuzzleException
     */
    public function getStream(string $uri, array $query = [],bool $stream=false): StreamInterface
    {
        return $this->client->get($uri, ['query'=>$query,'stream'=>$stream])->getBody();
    }

    /**
     * @param string $uri
     * @param array $query
     * @return array
     * @throws GuzzleException
     */
    public function getStreamHeader(string $uri, array $query = []): array
    {
        return $this->client->get($uri, compact('query'))->getHeaders();
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

    public function getAsync(array $urls = []): array
    {
        $promises = [];
        foreach ($urls as $key=>$url) {
            list($uri,$query) = $url;
            $promises[$key] = $this->client->getAsync($uri, compact('query'));
        }
        return (Utils::all($promises))->wait();
    }
}
