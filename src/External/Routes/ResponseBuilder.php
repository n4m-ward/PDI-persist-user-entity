<?php

namespace Newsletter\External\Routes;

use Laminas\Diactoros\Response;
use Laminas\Diactoros\ResponseFactory;
use Psr\Http\Message\ResponseInterface;

class ResponseBuilder
{
    public static function fromJson(int $statusCode = 200, array|string $response = null): ResponseInterface
    {
        $parsedResponse = empty($response) ? '' : json_encode($response);
        $response = (new ResponseFactory())->createResponse($statusCode);

        $response
            ->withHeader('Content-Type', 'application/json')
            ->getBody()
            ->write($parsedResponse);

        return $response;
    }
}