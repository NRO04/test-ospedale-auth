<?php

namespace Ospedale\Auth\Domain\ValueObjects;

class UserSessionInformation
{
    protected array $user_info;

    public function __construct(array $data_user)
    {
        $this->user_info = $data_user;
    }

    public function value(): array
    {
        return $this->user_info;
    }

}
