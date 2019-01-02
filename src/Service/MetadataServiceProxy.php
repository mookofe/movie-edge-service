<?php
declare(strict_types = 1);

namespace App\Service;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Proxy requests to Metadata service
 *
 * @author Victor Cruz <cruzrosario@gmail.com>
 */
class MetadataServiceProxy
{
    /**
     * @var Client
     */
    private $restClient;

    /**
     * @var string
     */
    private $baseUrl;

    /**
     * MetadataServiceProxy constructor.
     *
     * @param Client $restClient
     * @param string $baseUrl
     */
    public function __construct(Client $restClient, string $baseUrl)
    {
        $this->restClient = $restClient;
        $this->baseUrl = $baseUrl;
    }

    /**
     * Search metadata
     *
     * @param Request $request
     * @return ResponseInterface
     */
    public function search(Request $request): ResponseInterface
    {
        $queryString = http_build_query($request->query->all());
        $url = sprintf('%s/movie-meta-search?%s', $this->baseUrl, $queryString);

        return $this->restClient->get($url);
    }
}