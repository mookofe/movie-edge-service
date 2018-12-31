<?php
declare(strict_types = 1);

namespace App\Controller;

use App\Behavior\ResponseParserTrait;
use App\Service\MetadataServiceProxy;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;

/**
 * Class MetadataController
 *
 * @author Victor Cruz <cruzrosario@gmail.com>
 */
class MetadataController extends FOSRestController
{
    use ResponseParserTrait;

    /**
     * @var MetadataServiceProxy
     */
    private $metadataProxy;

    /**
     * MetadataController constructor.
     * @param MetadataServiceProxy $metadataProxy
     */
    public function __construct(MetadataServiceProxy $metadataProxy)
    {
        $this->metadataProxy = $metadataProxy;
    }

    /**
     * Get movie metadata by IMDB Id
     *
     * @Rest\Get("/movie-meta/{imdbId}")
     *
     * @param string $imdbId
     * @return Response
     */
    public function index(string $imdbId): Response
    {
        $meta = $this->metadataProxy->getByImdbId($imdbId);

        return $this->parseToResponse($meta);
    }

    /**
     * Get movie metadata by title
     *
     * @Rest\Get("/movie-meta-search")
     *
     * @param Request $request
     * @return Response
     */
    public function search(Request $request): Response
    {
        $meta = $this->metadataProxy->search($request);

        return $this->parseToResponse($meta);
    }
}