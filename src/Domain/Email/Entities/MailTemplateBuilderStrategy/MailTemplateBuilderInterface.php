<?php

namespace Newsletter\Domain\Email\Entities\MailTemplateBuilderStrategy;

use Newsletter\Domain\Email\Entities\EmailTemplate;

interface MailTemplateBuilderInterface
{
    public function buildEmailTemplate(): EmailTemplate;
}