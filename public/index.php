<?php

use Laminas\Diactoros\ResponseFactory;
use Laminas\Diactoros\ServerRequestFactory;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;
use Laminas\HttpHandlerRunner\RequestHandlerRunner;
use Laminas\Stratigility\MiddlewarePipe;
use Newsletter\External\Middleware\RoutingMiddleware;

require __DIR__ . '/../vendor/autoload.php';

$app = new MiddlewarePipe();

$app->pipe(middleware: new RoutingMiddleware());


$server = new RequestHandlerRunner(
    $app,
    new SapiEmitter(),
    static function () {
        return ServerRequestFactory::fromGlobals();
    },
    static function (\Throwable $e) {
        $response = (new ResponseFactory())->createResponse(500);
        $response->getBody()->write(sprintf(
            'An error occurred: %s',
            $e->getMessage()
        ));
        return $response;
    }
);

$server->run();