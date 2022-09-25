<?php

namespace Tests\Domain\Shared\User\UseCases;

use Newsletter\Domain\Shared\User\Exceptions\InvalidEmailException;
use Newsletter\Domain\Shared\User\UseCases\CreateUser;
use Newsletter\Repositories\Users\UserRepositoryInMemory;
use PHPUnit\Framework\TestCase;
use Tests\Domain\User\Dto\CreateUserDto;

class TestCreateUser extends TestCase
{
    private UserRepositoryInMemory $userRepositoryInMemory;
    private CreateUser $createUserUseCase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->userRepositoryInMemory = new UserRepositoryInMemory();
        $this->createUserUseCase = new CreateUser($this->userRepositoryInMemory);
    }

    /**
     * @throws InvalidEmailException
     */
    public function test_createUserWorks(): void
    {
        $createUserDto= new CreateUserDto(name: 'user test', email: 'validUser@gmail.com');
        $userCreated = $this->createUserUseCase->handle($createUserDto);

        $userInDatabase = $this->userRepositoryInMemory->getUserById($userCreated->id);

        $this->assertEquals($userCreated->name, $userInDatabase->name);
        $this->assertEquals($userCreated->email, $userInDatabase->email);
    }

    /**
     * @throws InvalidEmailException
     */
    public function test_createUserWithInvalidEmailShouldThrownAnException(): void
    {
        $this->expectException(InvalidEmailException::class);

        $createUserDto= new CreateUserDto(name: 'user test', email: 'invalid gmail.com');
        $this->createUserUseCase->handle($createUserDto);
    }
}