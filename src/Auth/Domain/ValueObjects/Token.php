<?php

namespace Ospedale\Auth\Domain\ValueObjects;

class Token
{
    protected string $token;

    public function __construct(string $value)
    {
        $this->token = $value;
    }

    public function value(): string
    {
        return $this->token;
    }
}
