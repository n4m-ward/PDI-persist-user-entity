<?php

namespace Newsletter\Domain\Email\Entities;

use Newsletter\Domain\Email\Entities\MailTemplateBuilderStrategy\MailTemplateBuilderInterface;
use Newsletter\Domain\Shared\User\Entities\Email as UserEmail;

class Email
{
    private EmailTemplate $emailTemplate;

    public function __construct(
        private readonly UserEmail $to,
        private readonly MailTemplateBuilderInterface $templateBuilder,
    )
    {
        $this->emailTemplate = $this->templateBuilder->buildEmailTemplate();
    }

    public function toArray(): array
    {
        return [
            'to' => (string) $this->to,
            'subject' => $this->emailTemplate->subject,
            'html' => $this->emailTemplate->html,
            'from' => 'From: Gabriel lima <gabrielphp00@gmail.com>'
        ];
    }
}