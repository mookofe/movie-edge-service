<?php

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
     * @return Request
     */
    private function getRequest(): Request
    {
        $queryString = [
            'title' => 'The Terminator'
        ];

        $query = $this->createMock(ParameterBag::class);
        $query->expects($this->once())
            ->method('all')
            ->willReturn($queryString);

        $request = $this->createMock(Request::class);
        $request->query = $query;

        return $request;
    }
}