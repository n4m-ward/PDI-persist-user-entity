<?php

namespace Newsletter\External\Routes;

class RouterDto
{
    public function __construct(
        public readonly string $method,
        public readonly string $path,
        public readonly array $controller,
    ) {}
}