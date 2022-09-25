<?php

namespace Newsletter\Domain\Shared\User\Entities;

use Newsletter\Domain\Shared\User\Exceptions\InvalidEmailException;

class Email
{
    private string $email;

    /**
     * @throws InvalidEmailException
     */
    public function __construct(string $email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidEmailException("email $email invalido");
        }

        $this->email = $email;
    }

    public function __toString()
    {
        return $this->email;
    }
}
