<?php

namespace Tests\External\Routes;

use Newsletter\External\Routes\ResponseBuilder;
use Psr\Http\Message\ResponseInterface;

class FakeControllerForTests
{
    public function handle(): ResponseInterface
    {
        return ResponseBuilder::fromJson();
    }
}