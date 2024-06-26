<?php

namespace WeWork\Http;

use Psr\Http\Message\StreamInterface;

interface HttpClientInterface
{
    /**
     * @param string $uri
     * @param array $query
     * @return array
     */
    public function get(string $uri, array $query = []): array;

    /**
     * @param string $uri
     * @param array $query
     * @param bool $stream
     * @return StreamInterface
     */
    public function getStream(string $uri, array $query = [],bool $stream=false): StreamInterface;

    /**
     * @param string $uri
     * @param array $query
     * @return array
     */
    public function getStreamHeader(string $uri, array $query = []): array;
    /**
     * @param string $uri
     * @param array $json
     * @param array $query
     * @return array
     */
    public function postJson(string $uri, array $json = [], array $query = []): array;

    /**
     * @param string $uri
     * @param string $path
     * @param array $query
     * @return array
     */
    public function postFile(string $uri, string $path, array $query = []): array;
    public function getAsync(array $urls = []):array;
}
