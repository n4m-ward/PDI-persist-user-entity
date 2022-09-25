<?php

namespace Tests\Domain\User\Entities;

use Newsletter\Domain\Shared\User\Entities\Email;
use Newsletter\Domain\Shared\User\Entities\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    private function createFakeUser(string $name = null, string $email = null): User
    {
        $defaultEmail = new Email('test@email.com');
        return User::withNameAndEmail(
            name: $name ?: 'test',
            email: $email ?: $defaultEmail
        );
    }
    public function test_createUserWorks(): void
    {
        $name = 'name test';
        $email = new Email('test@email.com');
        $user = User::withNameAndEmail(name: $name, email: $email);

        $this->assertEquals($name, $user->name);
        $this->assertEquals($email, $user->email);
    }

    public function test_updateUserNameWorks(): void
    {
        $userName = 'new user name';
        $user = $this->createFakeUser();
        $user = $user->updateUsername($userName);

        $this->assertEquals($userName, $user->name);
    }

    public function test_updateUserEmailWorks(): void
    {
        $userEmail = new Email('newUser@email.com');
        $user = $this->createFakeUser();
        $user = $user->updateEmail($userEmail);

        $this->assertEquals($userEmail, $user->email);
    }
}