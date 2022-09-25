<?php

namespace Newsletter\External\Routes;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class Router
{
    /**
     * @var array<RouterDto>
     */
    private static array $routes = [];

    public static function linkRouteByRequestToaRegisteredController(ServerRequestInterface $req): ResponseInterface
    {
        foreach (self::$routes as $routeDto) {
            if (RouterIsRightToBeRedirectedToController::isValid($req, $routeDto)) {
                [$controllerClass, $controllerMethod] = $routeDto->controller;
                return (new $controllerClass)->{$controllerMethod}($req);
            }
        }

        return ResponseBuilder::fromJson(statusCode: 404, response: 'NOT FOUND');
    }

    private static function register(string $method, string $path, array $controller): void
    {
        self::$routes[] = new RouterDto($method, $path, $controller);
    }

    public static function GET(string $path, array $controller): void
    {
        self::register('GET', $path, $controller);
    }

    public static function POST($path, $controller): void
    {
        self::register('POST', $path, $controller);
    }

    public static function PUT($path, $controller): void
    {
        self::register('PUT', $path, $controller);
    }

    public static function DELETE($path, $controller): void
    {
        self::register('DELETE', $path, $controller);
    }
}