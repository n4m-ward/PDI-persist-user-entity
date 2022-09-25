<?php

namespace Tests\Domain\Shared\UseCases;

interface UseCase
{
    public function handle(Dto $dto);
}