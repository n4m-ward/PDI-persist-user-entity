<?php

namespace Newsletter\Domain\Shared\Events;

use Newsletter\Domain\Shared\Events\Dto\DomainEventDto;

interface DomainEvent
{
    public function shouldListenEvent(DomainEventDto $dto): bool;
    public function handle(DomainEventDto $dto): void;
}