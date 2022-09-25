<?php

namespace Newsletter\Domain\Shared\User\Exceptions;

use DomainException;
use Throwable;

class InvalidEmailException extends DomainException implements Throwable
{
}
