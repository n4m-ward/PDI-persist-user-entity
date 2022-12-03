<?php

namespace Tests\External\Routes;

use GuzzleHttp\Psr7\ServerRequest;
use Newsletter\External\Routes\RouterDto;
use Newsletter\External\Routes\RouterIsRightToBeRedirectedToController;
use PHPUnit\Framework\TestCase;

class RouterIsRightToBeRedirectedToControllerTest extends TestCase
{
    use BuildMocksForRouter;
    private ServerRequest $serverRequestMock;

    protected function setUp(): void
    {
        parent::setUp();
        $this->serverRequestMock = $this->createMock(ServerRequest::class);
    }

    public function test_validatorReturnTrueIfRoutesAndMethodAreTheSame(): void
    {
        $this->mockRequestMethod($method = 'GET');
        $this->mockServerRequestPath($path = '/route/subroute');
        $controllerPath = '/route/subroute';

        $routeDto = new RouterDto(method: $method, path: $controllerPath, controller: []);
        $result = RouterIsRightToBeRedirectedToController::validate($this->serverRequestMock, $routeDto);

        $this->assertTrue($result);
    }

    public function test_validatorReturnFalseIfMethodAreDifferent(): void
    {
        $this->mockRequestMethod($method = 'POST');
        $this->mockServerRequestPath($path = '/route/subroute');
        $controllerPath = '/route/subroute';

        $routeDto = new RouterDto(method: 'GET', path: $controllerPath, controller: []);
        $result = RouterIsRightToBeRedirectedToController::validate($this->serverRequestMock, $routeDto);

        $this->assertFalse($result);
    }

    public function test_validatorReturnFalseIfRouteIsDifferent(): void
    {
        $this->mockRequestMethod($method = 'POST');
        $this->mockServerRequestPath($path = '/route/subroute/other-subroute');
        $controllerPath = '/route/subroute';

        $routeDto = new RouterDto(method: $method, path: $controllerPath, controller: []);
        $result = RouterIsRightToBeRedirectedToController::validate($this->serverRequestMock, $routeDto);

        $this->assertFalse($result);
    }

    public function test_validatorReturnTrueIfMethodIsSameAndRouteAreEqualButWithQueryParameters(): void
    {
        $this->mockRequestMethod($method = 'GET');
        $this->mockServerRequestPath($path = '/route/subroute?test=123');
        $controllerPath = '/route/subroute';

        $routeDto = new RouterDto(method: $method, path: $controllerPath, controller: []);
        $result = RouterIsRightToBeRedirectedToController::validate($this->serverRequestMock, $routeDto);

        $this->assertTrue($result);
    }
}
