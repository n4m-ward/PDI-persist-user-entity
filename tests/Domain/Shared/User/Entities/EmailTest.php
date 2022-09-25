<?php

namespace Tests\Domain\Shared\User\Entities;

use Newsletter\Domain\Shared\User\Entities\Email;
use Newsletter\Domain\Shared\User\Exceptions\InvalidEmailException;
use PHPUnit\Framework\TestCase;

class EmailTest extends TestCase
{
    /**
     * @throws InvalidEmailException
     */
    public function test_createEmailWork(): void
    {
        $validEmail = 'test@email.com';
        $emailEntity = new Email($validEmail);

        $this->assertEquals($validEmail, $emailEntity);
    }

    public function test_createEmailWithoutArrobaShouldThrownAnException(): void
    {
        $invalidEmail = 'testemail.com';

        $this->expectException(InvalidEmailException::class);
        $this->expectDeprecationMessage("email $invalidEmail invalido");

        new Email($invalidEmail);
    }

    public function test_createEmailWithoutDotShouldThrownAnException(): void
    {
        $invalidEmail = 'test@emailcom';

        $this->expectException(InvalidEmailException::class);
        $this->expectDeprecationMessage("email $invalidEmail invalido");

        new Email($invalidEmail);
    }
}
