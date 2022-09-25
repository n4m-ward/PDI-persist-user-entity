<?php

namespace Newsletter\Domain\Shared\User\UseCases;

use Newsletter\Domain\Shared\User\Entities\Email;
use Newsletter\Domain\Shared\User\Entities\User;
use Newsletter\Domain\Shared\User\Exceptions\InvalidEmailException;
use Newsletter\Domain\Shared\User\Ports\UserRepository;
use Tests\Domain\User\Dto\CreateUserDto;

class CreateUser
{
    public function __construct(
        private readonly UserRepository $userRepository
    ) { }

    /**
     * @throws InvalidEmailException
     */
    public function handle(CreateUserDto $dto): User
    {
        $email = new Email($dto->email);
        $user = User::withNameAndEmail(name: $dto->name, email: $email);
        return  $this->userRepository->createUser($user);
    }
}