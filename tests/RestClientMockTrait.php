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
     * List of allowed methods
     *
     * @var string[]
     */
    private $allowedMethods = [
        'get',
        'post',
        'put',
        'delete'
    ];

    /**
     * Get mocked guzzle client
     *
     * @param  ResponseInterface $response
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
                if (in_array($methodName, $this->allowedMethods)){
                    return $response;
                }
            });

        return $client;
    }
}