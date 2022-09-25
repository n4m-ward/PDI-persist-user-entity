<?php

namespace Newsletter\Domain\Shared\User\Dto;

class CreateUserDto implements Dto
{
    public function __construct(
        public readonly string $name,
        public readonly string $email
    ) {
    }
}
