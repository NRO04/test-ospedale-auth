<?php

namespace Ospedale\Auth\Domain\Entity;

use Ospedale\Auth\Domain\ValueObjects\Token;
use Ospedale\Auth\Domain\ValueObjects\UserSessionInformation;
use Ro\DtoPhp\Infrastructure\DTO;

class AuthEntity
{
    protected Token $token;
    protected UserSessionInformation $userSessionInformation;

    public function __construct(Token $token, UserSessionInformation $userSessionInformation = null)
    {
        $this->token = $token;
        $this->userSessionInformation = $userSessionInformation;
    }

    public static function fromArray(DTO $DTO): AuthEntity
    {
        return new self(new Token($DTO->get('token')),
            new UserSessionInformation($DTO->get('user_info')));
    }

    public function getSessionWithToken(): array
    {
        return [
            "token" => $this->token->value(),
            'token_type' => 'bearer',
            "user_info" => $this->userSessionInformation->value()
        ];
    }
}
