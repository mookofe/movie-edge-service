<?php
declare(strict_types = 1);

namespace App\Service;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Proxy requests to movie service
 *
 * @author Victor Cruz <cruzrosario@gmail.com>
 */
class MovieServiceProxy
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
     * MovieServiceProxy constructor.
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
     * Get all movies
     *
     * @param Request $request
     * @return ResponseInterface
     */
    public function getList(Request $request): ResponseInterface
    {
        $queryString = http_build_query($request->query->all());
        $url = sprintf('%s/movies?%s', $this->baseUrl, $queryString);

        return $this->restClient->get($url);
    }

    /**
     * Get movie by id
     *
     * @param int $id
     * @return ResponseInterface
     */
    public function getById(int $id): ResponseInterface
    {
        $url = sprintf('%s/movies/%s', $this->baseUrl, $id);

        return $this->restClient->get($url);
    }

    /**
     * Store movie
     *
     * @param Request $request
     * @return ResponseInterface
     */
    public function store(Request $request): ResponseInterface
    {
        $url = sprintf('%s/movies', $this->baseUrl);

        return $this->restClient->post(
            $url,
            $this->buildOptionsFromRequest($request)
        );
    }

    /**
     * Update movie
     *
     * @param Request $request
     * @param int $id
     * @return ResponseInterface
     */
    public function update(Request $request, int $id): ResponseInterface
    {
        $url = sprintf('%s/movies/%s', $this->baseUrl, $id);

        return $this->restClient->put(
            $url,
            $this->buildOptionsFromRequest($request)
        );
    }

    /**
     * Delete movie
     *
     * @param int $id
     * @return ResponseInterface
     */
    public function delete(int $id): ResponseInterface
    {
        $url = sprintf('%s/movies/%s', $this->baseUrl, $id);

        return $this->restClient->delete($url);
    }

    /**
     * Build guzzle options from Request
     *
     * @param Request $request
     * @return array
     */
    private function buildOptionsFromRequest(Request $request): array
    {
        return [
            'json' => $request->request->all()
        ];
    }
}