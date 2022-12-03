<?php

namespace Newsletter\External\Routes;

class RouterDto
{
    /**
     * @param array<string> $controller
     */
    public function __construct(
        public readonly string $method,
        public readonly string $path,
        public readonly array $controller,
    ) {
    }
}
