<?php

namespace Newsletter\Domain\Shared\User\Entities;

class User
{
    public function __construct(
        public readonly string $id,
        public readonly string $name,
        public readonly Email $email
    )
    {}

    public static function withNameAndEmail(string $name, Email $email): self {
        return new self(id: uniqid(), name: $name, email: $email);
    }

    public function updateEmail(Email $email): self
    {
        return new self($this->id, $this->name, $email);
    }

    public function updateUsername(string $username): self
    {
        return new self($this->id, $username, $this->email);
    }
}
