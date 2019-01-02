<?php
declare(strict_types = 1);

namespace App\Tests\Service;

use App\Tests\RequestMockTrait;
use PHPUnit\Framework\TestCase;
use App\Tests\RestClientMockTrait;
use App\Service\MetadataServiceProxy;
use Psr\Http\Message\ResponseInterface;

/**
 * Tests for class MetadataServiceProxy
 *
 * @author Victor Cruz <cruzrosario@gmail.com>
 */
class MetadataServiceProxyTest extends TestCase
{
    use RequestMockTrait;
    use RestClientMockTrait;

    /**
     * Test search method
     */
    public function testSearch(): void
    {
        $client = $this->getRestClient();
        $baseUrl = 'http://localhost/api/';

        $service = new MetadataServiceProxy($client, $baseUrl);
        $request = $this->getRequest();
        $response = $service->search($request);

        $this->assertInstanceOf(ResponseInterface::class, $response);
    }
}