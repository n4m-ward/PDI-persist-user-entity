<?php


namespace Newsletter\Domain\Email\Entities\MailTemplateBuilderStrategy;

use Newsletter\Domain\Email\Entities\EmailTemplate;
use Newsletter\Domain\Shared\User\Entities\User;

class UserConfirmationEmailTemplateBuilder implements MailTemplateBuilderInterface
{
    public function __construct(
        private readonly User $user
    ) { }

    public const RAW_HTML_SUBJECT = "Confirmação de cadastro - Minha Newsletter";
    public const RAW_HTML_CONTENT = "
<p>Ol&aacute; {{USER_NAME}}, seja bem vindo a minha newsletter.</p>
<p>Para confirmar seu cadastro, <a href='http://localhost:8080/confirm-user?user_id={{USER_ID}}'>clique aqui</a>.</p>
<p>Se n&atilde;o foi voc&ecirc; quem fez o cadastro, por favor desconsiderar este email.</p>";

    public function buildEmailTemplate(): EmailTemplate
    {
        return new EmailTemplate(subject: self::RAW_HTML_SUBJECT, html: self::buildHtml());
    }

    public function buildHtml(): string
    {
        $newHtml = null;
        foreach ($this->getKeysToOverride() as $keysToOverride => $contentToOverride) {
            $htmlToOverride = $newHtml ?: self::RAW_HTML_CONTENT;
            $newHtml = str_replace($keysToOverride, $contentToOverride, $htmlToOverride);
        }

        return $newHtml;
    }

    private function getKeysToOverride(): array
    {
        return [
            '{{USER_NAME}}' => $this->user->name,
            '{{USER_ID}}'=> $this->user->id
        ];
    }
}