<?php

namespace Tests\External\Routes;

class DependencyInjection
{
    private static array $contents = [];

    public static function register(string $registerId, $object): void
    {
        self::$contents[$registerId] = $object;
    }

    public static function get(string $registerId)
    {
        $registeredObject = self::$contents[$registerId] ?? null;

        if(isset($registeredObject)) {
            return $registeredObject;
        }

        return new $registerId();
    }
}