<?php
declare(strict_types = 1);

namespace App\Behavior;

use Psr\Http\Message\ResponseInterface;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ResponseParserTrait
 *
 * @author Victor Cruz <cruzrosario@gmail.com>
 */
trait ResponseParserTrait
{
    /**
     * Parse guzzle response to http response
     *
     * @param ResponseInterface $response
     * @return Response
     */
    private function parseToResponse(ResponseInterface $response): Response
    {
        $json = (string) $response->getBody();

        return new Response($json, $response->getStatusCode());
    }
}