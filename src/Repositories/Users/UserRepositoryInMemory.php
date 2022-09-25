<?php

namespace Newsletter\Repositories\Users;

use Newsletter\Domain\Shared\User\Entities\User;
use Newsletter\Domain\Shared\User\Ports\UserRepository;

class UserRepositoryInMemory implements UserRepository
{
    /**
     * @var array<User>
     */
    private $users = [];

    public function createUser(User $user): User
    {
        $this->users[$user->id] = $user;

        return $user;
    }

    public function getUserById(string $id): User
    {
        return $this->users[$id];
    }
}