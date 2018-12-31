<?php
declare(strict_types = 1);

namespace App\Controller;

use App\Service\MovieServiceProxy;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;

/**
 * Class MovieController
 *
 * @author Victor Cruz <cruzrosario@gmail.com>
 */
class MovieController extends FOSRestController
{
    /**
     * @var MovieServiceProxy
     */
    private $movieServiceProxy;

    /**
     * MovieController constructor.
     * @param MovieServiceProxy $movieServiceProxy
     */
    public function __construct(MovieServiceProxy $movieServiceProxy)
    {
        $this->movieServiceProxy = $movieServiceProxy;
    }

    /**
     * Show list of movies
     *
     * @Rest\Get("/movies")
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        $movies = $this->movieServiceProxy->getList($request);

        return $this->parseToResponse($movies);
    }

    /**
     * @Rest\Get("/movies/{id}")
     *
     * @param int $id
     * @return Response
     */
    public function show(int $id): Response
    {
        $movie = $this->movieServiceProxy->getById($id);

        return $this->parseToResponse($movie);
    }

    /**
     * @Rest\Post("/movies")
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request): Response
    {
        $movie = $this->movieServiceProxy->store($request);

        return $this->parseToResponse($movie);
    }

    /**
     * @Rest\Put("/movies/{id}")
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, int $id): Response
    {
        $movie = $this->movieServiceProxy->update($request, $id);

        return $this->parseToResponse($movie);
    }

    /**
     * @Rest\Delete("/movies/{id}")
     *
     * @param int $id
     * @return Response
     */
    public function delete(int $id): Response
    {
        $this->movieServiceProxy->delete($id);

        return new Response();
    }

    /**
     * Parse guzzle response to http response
     *
     * @param ResponseInterface $response
     * @return Response
     */
    private function parseToResponse(ResponseInterface $response): Response
    {
        $json = (string) $response->getBody();

        return new Response($json);
    }
}