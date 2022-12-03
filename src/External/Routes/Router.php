<?php

namespace Newsletter\External\Routes;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Tests\External\Routes\DependencyInjection;

class Router
{
    /**
     * @var array<RouterDto>
     */
    private static array $routes = [];

    public static function linkRouteByRequestToaRegisteredController(ServerRequestInterface $req): ResponseInterface
    {
        foreach (self::$routes as $routeDto) {
            if (RouterIsRightToBeRedirectedToController::validate($req, $routeDto)) {
                [$controllerClass, $controllerMethod] = $routeDto->controller;
                $controller = DependencyInjection::get($controllerClass);

                return $controller->{$controllerMethod}($req);
            }
        }

        return ResponseBuilder::fromJson(statusCode: 404, response: 'NOT FOUND');
    }

    /**
     * @param array<string> $controller
     */
    private static function register(string $method, string $path, array $controller): void
    {
        self::$routes[] = new RouterDto($method, $path, $controller);
    }

    /**
     * @param array<string> $controller
     */
    public static function GET(string $path, array $controller): void
    {
        self::register('GET', $path, $controller);
    }

    /**
     * @param array<string> $controller
     */
    public static function POST(string $path, $controller): void
    {
        self::register('POST', $path, $controller);
    }

    /**
     * @param array<string> $controller
     */
    public static function PUT(string $path, $controller): void
    {
        self::register('PUT', $path, $controller);
    }

    /**
     * @param array<string> $controller
     */
    public static function DELETE(string $path, $controller): void
    {
        self::register('DELETE', $path, $controller);
    }
}
