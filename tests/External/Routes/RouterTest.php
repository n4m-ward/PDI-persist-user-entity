<?php

namespace Tests\External\Routes;

use GuzzleHttp\Psr7\ServerRequest;
use Newsletter\External\Routes\ResponseBuilder;
use Newsletter\External\Routes\Router;
use PHPUnit\Framework\TestCase;

class RouterTest extends TestCase
{
    use BuildMocksForRouter;

    private ServerRequest $serverRequestMock;
    private FakeControllerForTests $fakeControllerMock;

    protected function setUp(): void
    {
        parent::setUp();
        $this->serverRequestMock = $this->createMock(ServerRequest::class);
        $this->fakeControllerMock = $this->createMock(FakeControllerForTests::class);

        DependencyInjection::register(
            FakeControllerForTests::class,
            $this->fakeControllerMock
        );
    }

    public function test_RouteCallCorrectController(): void
    {
        $this->mockRequestMethod('GET');
        $this->mockServerRequestPath($path = '/route/subroute');

        $this->fakeControllerMock
            ->expects($this->once())
            ->method($controllerMethod = 'handle');
        $this
            ->fakeControllerMock
            ->method('handle')
            ->willReturn(ResponseBuilder::fromJson());


        Router::GET($path, [FakeControllerForTests::class, $controllerMethod]);
        Router::linkRouteByRequestToaRegisteredController($this->serverRequestMock);
    }

    public function test_RouteCallCorrectControllerWithCorrectPathAndQueryString(): void
    {
        $this->mockRequestMethod('GET');
        $this->mockServerRequestPath('/route/subroute?querystring=test');

        $this->fakeControllerMock
            ->expects($this->once())
            ->method($controllerMethod = 'handle');
        $this
            ->fakeControllerMock
            ->method('handle')
            ->willReturn(ResponseBuilder::fromJson());


        Router::GET('/route/subroute', [FakeControllerForTests::class, $controllerMethod]);
        Router::linkRouteByRequestToaRegisteredController($this->serverRequestMock);
    }

    public function test_RouteNotCallCorrectControllerIfMethodAreDifferent(): void
    {
        $this->mockRequestMethod('GET');
        $this->mockServerRequestPath($path = '/route/subroute/new-subroute');

        $this->fakeControllerMock
            ->expects($this->never())
            ->method($controllerMethod = 'handle');

        Router::POST($path, [FakeControllerForTests::class, $controllerMethod]);
        $result = Router::linkRouteByRequestToaRegisteredController($this->serverRequestMock);

        $this->assertEquals(404, $result->getStatusCode());
    }

    public function test_RouteNotCallCorrectControllerIfRouteIsIncorrect(): void
    {
        $this->mockRequestMethod('GET');
        $this->mockServerRequestPath($path = '/route/subroute/new-subroute2');

        $this->fakeControllerMock
            ->expects($this->never())
            ->method($controllerMethod = 'handle');

        Router::GET('/route/subroute/new-subroute3', [FakeControllerForTests::class, $controllerMethod]);
        $result = Router::linkRouteByRequestToaRegisteredController($this->serverRequestMock);

        $this->assertEquals(404, $result->getStatusCode());
    }
}
