<?php
declare(strict_types = 1);

namespace App\Tests\Service;

use App\Tests\RequestMockTrait;
use PHPUnit\Framework\TestCase;
use App\Tests\RestClientMockTrait;
use App\Service\MovieServiceProxy;
use Psr\Http\Message\ResponseInterface;

/**
 * Tests for class MovieServiceProxy
 *
 * @author Victor Cruz <cruzrosario@gmail.com>
 */
class MovieServiceProxyTest extends TestCase
{
    use RequestMockTrait;
    use RestClientMockTrait;

    /**
     * Base url
     *
     * @var string
     */
    private const BASE_URL = 'http://localhost/api';

    /**
     * Test getList method
     */
    public function testGetList(): void
    {
        $client = $this->getRestClient();
        $request = $this->getRequest();

        $movieService = new MovieServiceProxy($client, self::BASE_URL);
        $movies = $movieService->getList($request);

        $this->assertInstanceOf(ResponseInterface::class, $movies);
    }

    /**
     * Test getById method
     */
    public function testGetById(): void
    {
        $client = $this->getRestClient();

        $movieService = new MovieServiceProxy($client, self::BASE_URL);
        $movie = $movieService->getById(1);

        $this->assertInstanceOf(ResponseInterface::class, $movie);
    }

    /**
     * Test getById method
     */
    public function testStore(): void
    {
        $request = $this->getRequest();
        $client = $this->getRestClient();

        $movieService = new MovieServiceProxy($client, self::BASE_URL);
        $movie = $movieService->store($request);

        $this->assertInstanceOf(ResponseInterface::class, $movie);
    }

    /**
     * Test getById method
     */
    public function testUpdate(): void
    {
        $request = $this->getRequest();
        $client = $this->getRestClient();

        $movieService = new MovieServiceProxy($client, self::BASE_URL);
        $movie = $movieService->update($request, 1);

        $this->assertInstanceOf(ResponseInterface::class, $movie);
    }

    /**
     * Test getById method
     */
    public function testDelete(): void
    {
        $client = $this->getRestClient();

        $movieService = new MovieServiceProxy($client, self::BASE_URL);
        $movie = $movieService->delete(1);

        $this->assertInstanceOf(ResponseInterface::class, $movie);
    }
}