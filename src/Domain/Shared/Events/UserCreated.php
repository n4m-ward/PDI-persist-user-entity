<?php

namespace Newsletter\Domain\Shared\Events;

use Newsletter\Adapters\Email\FakeMailServiceForTest;
use Newsletter\Domain\Email\Entities\MailTemplateBuilderStrategy\UserConfirmationEmailTemplateBuilder;
use Newsletter\Domain\Email\UseCases\SendAccountConfirmationEmail;
use Newsletter\Domain\Shared\Events\Dto\DomainEventDto;

class UserCreated implements DomainEvent
{
    public function shouldListenEvent(DomainEventDto $dto): bool
    {
        return $dto->event === Events::UserCreated;
    }

    public function handle(DomainEventDto $dto): void
    {
        $mailService = new FakeMailServiceForTest();
        $builder = new UserConfirmationEmailTemplateBuilder($dto->user);
        $sendEmail = new SendAccountConfirmationEmail(mailService: $mailService,mailTemplateBuilder: $builder);
        $sendEmail->handle($dto->user->email);
    }
}