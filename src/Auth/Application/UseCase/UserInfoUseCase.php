<?php

namespace Ospedale\Auth\Application\UseCase;

use Ospedale\Auth\Domain\Repository\AuthRepository;

class UserInfoUseCase
{
    protected AuthRepository $authRepository;

    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function execute()
    {
        return $this->authRepository->me();
    }
}
