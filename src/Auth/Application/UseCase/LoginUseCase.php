<?php

namespace Ospedale\Auth\Application\UseCase;

use Ospedale\Auth\Domain\Entity\AuthEntity;
use Ospedale\Auth\Domain\Repository\AuthRepository;
use Ro\DtoPhp\Infrastructure\DTO;

class LoginUseCase
{

    protected AuthRepository $authRepository;
    protected array $usesCases;

    function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
        $this->usesCases = ["UserInfoUseCase" => new UserInfoUseCase($this->authRepository)];
    }

    function execute(DTO $DTO)
    {
        $token = $this->authRepository->login($DTO->get("CREDENTIALS"));
        $use_info = $this->usesCases["UserInfoUseCase"]->execute();
        $DTO->set([[
            "token" => $token,
            "use_info" => $use_info
        ]]);
        return AuthEntity::fromArray($DTO)->getSessionWithToken();
    }


}
