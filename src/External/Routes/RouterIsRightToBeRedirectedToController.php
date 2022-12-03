<?php

namespace Newsletter\External\Routes;

use Psr\Http\Message\ServerRequestInterface;

class RouterIsRightToBeRedirectedToController
{
    public static function validate(ServerRequestInterface $req, RouterDto $routerDto): bool
    {
        if ($req->getMethod() !== $routerDto->method) {
            return false;
        }
        $path = $req->getUri()->getPath();

        return self::routeHasCorrectPath($path, $routerDto);
    }

    private static function routeHasCorrectPath(string $path, RouterDto $routerDto): bool
    {
        $controllerPathLength = strlen($routerDto->path);
        $pathWithSubstrOfSameLengthOfControllerPath = substr($path, 0, $controllerPathLength);

        if ($pathWithSubstrOfSameLengthOfControllerPath !== $routerDto->path) {
            return false;
        }

        $requestPathLength = strlen($path);

        if ($controllerPathLength === $requestPathLength) {
            return true;
        }

        $stringAfterTheEndOfRequestPath = substr($path, $controllerPathLength, 1);
        $requestHasQueryParams = $stringAfterTheEndOfRequestPath == '?';

        if ($requestHasQueryParams) {
            return true;
        }

        return false;
    }
}
