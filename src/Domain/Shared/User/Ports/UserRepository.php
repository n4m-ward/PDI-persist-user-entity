<?php

namespace Newsletter\Domain\Shared\User\Ports;

use Newsletter\Domain\Shared\User\Entities\User;

interface UserRepository
{
    public function createUser(User $user): User;
    public function getUserById(string $id): ?User;
}
