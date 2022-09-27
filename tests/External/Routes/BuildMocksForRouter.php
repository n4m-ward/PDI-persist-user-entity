<?php

namespace Tests\External\Routes;

use Exception;
use GuzzleHttp\Psr7\Uri;

trait BuildMocksForRouter
{
    /**
     * @throws Exception
     */
    private function validateTraitIsValidToUse(): void
    {
        $serverRequestMockExist = property_exists(new self, 'serverRequestMock');

        if(!$serverRequestMockExist) {
            throw new Exception('Seu teste precisa da variavel serverRequestMock para usar essa trait');
        }
    }

    private function mockServerRequestPath(string $path): void
    {
        $this->validateTraitIsValidToUse();

        $uriMock = $this->createMock(Uri::class);
        $uriMock
            ->method('getPath')
            ->willReturn($path);
        $this
            ->serverRequestMock
            ->method('getUri')
            ->willReturn($uriMock);
    }

    private function mockRequestMethod(string $method): void
    {
        $this->validateTraitIsValidToUse();

        $this
            ->serverRequestMock
            ->method('getMethod')
            ->willReturn($method);
    }
}