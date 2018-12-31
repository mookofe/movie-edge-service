<?php

namespace App\Tests;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

/**
 * Trait RestClientMockTrait
 *
 * @author Victor Cruz <cruzrosario@gmail.com>
 */
trait RestClientMockTrait
{
    /**
     * Get mocked guzzle client
     *
     * @return Client
     */
    private function getRestClient(ResponseInterface $response = null): Client
    {
        if ($response === null){
            $response = $response = $this->createMock(ResponseInterface::class);
        }

        $client = $this->createMock(Client::class);
        $client->expects($this->once())
            ->method('__call')
            ->willReturnCallback(function(string $methodName, array $arguments) use  ($response){
                if ($methodName === 'get'){
                    return $response;
                }
            });

        return $client;
    }
}