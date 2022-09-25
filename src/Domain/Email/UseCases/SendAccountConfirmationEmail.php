<?php

namespace Newsletter\Domain\Email\UseCases;

use Newsletter\Domain\Email\Entities\Email;
use Newsletter\Domain\Email\Entities\MailTemplateBuilderStrategy\MailTemplateBuilderInterface;
use Newsletter\Domain\Email\Ports\SendMailService;
use Newsletter\Domain\Shared\User\Entities\Email as UserEmail;

class SendAccountConfirmationEmail
{
    public function __construct(
        private readonly SendMailService $mailService,
        private readonly MailTemplateBuilderInterface $mailTemplateBuilder,
    ) { }

    public function handle(UserEmail $to): void
    {
        $email = new Email($to, $this->mailTemplateBuilder);
        $this->mailService->sendMail($email);
    }
}