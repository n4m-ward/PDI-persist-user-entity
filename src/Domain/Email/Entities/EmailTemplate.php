<?php

namespace Newsletter\Domain\Email\Entities;

class EmailTemplate
{
    public function __construct(
        public readonly string $subject,
        public readonly string $html
    ) {}
}