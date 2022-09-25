<?php

namespace Newsletter\Domain\Shared\Events;

use Newsletter\Domain\Shared\Events\Dto\DomainEventDto;

class Event
{
    /**
     * @type Array<DomainEvent>
     */
    private const EVENTS = [
        UserCreated::class,
    ];

    public static function dispatch(DomainEventDto $dto): void
    {
        foreach (self::EVENTS as $eventClass) {
            $domainEvent = new $eventClass();
            if ($domainEvent->shouldListenEvent($dto)) {
               $domainEvent->handle($dto);
            }
        }
    }
}