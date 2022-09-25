<?php

namespace Newsletter\Domain\Shared\Events\Dto;

use Newsletter\Domain\Shared\Events\Events;
use Newsletter\Domain\Shared\User\Entities\User;

class DomainEventDto
{
    public function __construct(
        public readonly Events $event,
        public readonly User $user
    ) {}
}