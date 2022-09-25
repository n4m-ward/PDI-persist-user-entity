<?php

namespace Tests\Domain\Shared\User\UseCases;

use Newsletter\Domain\Shared\User\Dto\CreateUserDto;
use Newsletter\Domain\Shared\User\Exceptions\InvalidEmailException;
use Newsletter\Domain\Shared\User\UseCases\CreateUser;
use Newsletter\Repositories\Users\UserRepositoryInMemory;
use PHPUnit\Framework\TestCase;

class TestCreateUser extends TestCase
{
    private UserRepositoryInMemory $userRepositoryInMemory;
    private CreateUser $createUser;

    protected function setUp(): void
    {
        parent::setUp();
        $this->userRepositoryInMemory = new UserRepositoryInMemory();
        $this->createUser = new CreateUser($this->userRepositoryInMemory);
    }

    public function test_handleCreateUserStoreUserInDatabase(): void
    {
        $user = new CreateUserDto(name: 'test user', email: 'test@gmail.com');
        $userSaved = $this->createUser->handle($user);
        $userSavedInDatabase = $this->userRepositoryInMemory->getUserById($userSaved->id);

        $this->assertNotNull($userSavedInDatabase);
        $this->assertEquals($userSavedInDatabase->email, $user->email);
    }

    public function test_handleShouldThrownAnErrorIfEmailIsInvalid(): void
    {
        $this->expectException(InvalidEmailException::class);

        $user = new CreateUserDto(name: 'test user', email: 'test gmail com');
        $userSaved = $this->createUser->handle($user);
        $this->userRepositoryInMemory->getUserById($userSaved->id);
    }
}
