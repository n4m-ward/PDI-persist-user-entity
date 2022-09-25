<?php

namespace Newsletter\Adapters\Email;

use Newsletter\Domain\Email\Entities\Email;
use Newsletter\Domain\Email\Ports\SendMailService;

class FakeMailServiceForTest implements SendMailService
{
    public function sendMail(Email $email): void
    {
        $emailArray = $email->toArray();
        $emailJson = json_encode($emailArray);
    }
}