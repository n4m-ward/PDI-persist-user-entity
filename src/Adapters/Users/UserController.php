<?php

namespace Newsletter\Adapters\Users;

use Laminas\Diactoros\ServerRequest;
use Newsletter\Domain\Shared\User\Exceptions\DomainException;
use Newsletter\Domain\Shared\User\UseCases\CreateUser;
use Newsletter\External\Routes\ResponseBuilder;
use Newsletter\Repositories\Users\UserRepositoryInMemory;
use Psr\Http\Message\ResponseInterface;
use Tests\Domain\User\Dto\CreateUserDto;

class UserController
{
    public static function createUser(ServerRequest $req): ResponseInterface
    {
        $body = json_decode($req->getBody()->getContents());
        $userName = $body->name;
        $userEmail = $body->email;

        $userRepositoryInMemory = new UserRepositoryInMemory();
        $createUser = new CreateUser($userRepositoryInMemory);
        try {
            $userDto = new CreateUserDto(name: $userName, email: $userEmail);
            $createUser->handle($userDto);
        } catch (DomainException $domainException) {
            return ResponseBuilder::fromJson(
                statusCode: 400,
                response: [
                    'error' => true,
                    'result' => $domainException->getMessage()
                ]
            );
        }
        catch (\Throwable $exception) {
            return ResponseBuilder::fromJson(
                statusCode: 500,
                response: [
                    'error' => true,
                    'result' => $exception->getMessage()
                ]
            );
        }

        return ResponseBuilder::fromJson(response: ['error' => false, 'result' => 'success']);
    }
}