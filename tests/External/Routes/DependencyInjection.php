<?php

namespace Tests\External\Routes;

class DependencyInjection
{
    private static array $contents = []; // @phpstan-ignore-line

    public static function register(string $registerId, $object): void // @phpstan-ignore-line
    {
        self::$contents[$registerId] = $object;
    }

    public static function get(string $registerId) // @phpstan-ignore-line
    {
        $registeredObject = self::$contents[$registerId] ?? null;

        if (isset($registeredObject)) {
            return $registeredObject;
        }

        return new $registerId();
    }
}
