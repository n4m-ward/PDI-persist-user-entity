<?php

namespace Newsletter\Domain\Email\Ports;

use Newsletter\Domain\Email\Entities\Email;

interface SendMailService
{
    public function sendMail(Email $email): void;
}