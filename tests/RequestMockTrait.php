<?php
declare(strict_types = 1);

namespace App\Tests;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Trait RequestMockTrait
 *
 * @author Victor Cruz <cruzrosario@gmail.com>
 */
trait RequestMockTrait
{
    /**
     * Get mocked Request
     *
     * @param  array $body
     * @return Request
     */
    private function getRequest(array $body = []): Request
    {
        $requestBody = $this->createMock(ParameterBag::class);
        $requestBody->method('all')
            ->willReturn($body);

        $queryString = [
            'title' => 'The Terminator'
        ];

        $query = $this->createMock(ParameterBag::class);
        $query->method('all')
            ->willReturn($queryString);

        $request = $this->createMock(Request::class);
        $request->query = $query;
        $request->request = $requestBody;

        return $request;
    }
}