<?php

namespace WeWork\Http;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Promise\Promise;
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
        foreach ($urls as $url => $query) {
            $promises[$url] = $this->client->getAsync($url, compact('query'));
        }
        // 等待所有请求完成
        $results = (new Promise($promises))->wait();
        // 处理每个请求的响应
        foreach ($results as $url => $result) {
            print_r($result);
            if ($result['state'] === 'fulfilled') {
                // 处理成功的响应
                $response = $result['value'];
                echo "Response from $url: " . $response->getBody()->getContents() . "\n";
            } else {
                // 处理失败的请求
                $reason = $result['reason'];
                echo "Request to $url failed: $reason\n";
            }
        }
        return [];
    }
}
