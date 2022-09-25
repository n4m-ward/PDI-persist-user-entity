<?php

namespace Tests\Domain\User\Dto;

use Tests\Domain\Shared\UseCases\Dto;

class CreateUserDto implements Dto
{
    public function __construct(
        public readonly string $name,
        public readonly string $email
    ) {}
}