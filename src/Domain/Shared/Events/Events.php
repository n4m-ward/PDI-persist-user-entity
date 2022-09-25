<?php

namespace Newsletter\Domain\Shared\Events;

enum Events: string
{
    case UserCreated = 'user.created';
}
