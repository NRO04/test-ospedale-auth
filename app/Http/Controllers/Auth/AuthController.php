<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthRequest;
use Illuminate\Http\Request;
use Ospedale\Auth\Application\UseCase\LoginUseCase;
use Ospedale\Auth\Application\UseCase\LogOutUseCase;
use Ospedale\Auth\Application\UseCase\UserInfoUseCase;
use Ospedale\Auth\Domain\Services\AuthService;
use Ro\DtoPhp\Domain\Services\DtoMappingService;
use Ro\DtoPhp\Infrastructure\DTO;

class AuthController extends Controller
{

    protected array $useCase;
    protected AuthService $authService;
    const INITIALIZE_STATE = ["MODULE" => "AUTH"];
    protected DTO $DTO;

    public function __construct(AuthService $service)
    {

        $this->authService = $service;
        $this->DTO = new DTO(new DtoMappingService(self::INITIALIZE_STATE));
        $this->useCase = [
            "LoginUseCase" => new LoginUseCase($this->authService),
            "LogOutUseCase" => new LogOutUseCase($this->authService),
            "UserInfoUseCase" => new UserInfoUseCase($this->authService)
        ];
    }


    public function login(AuthRequest $request)
    {

        try {
            $this->DTO->set(["CREDENTIALS" => $request->all()]);
            $data = $this->useCase["LoginUseCase"]->execute($this->DTO);
        } catch (\Exception $exception) {
            $data = $exception->getMessage();
        }
        return response()->json($data);
    }

    public function logout()
    {
        try {
            $data = $this->useCase["LogOutUseCase"]->execute();
        } catch (\Exception $exception) {
            $data = $exception->getMessage();
        }
        return response()->json($data);
    }


    public function me()
    {
        try {
            $data = $this->useCase["UserInfoUseCase"]->execute();
        } catch (\Exception $exception) {
            $data = $exception->getMessage();
        }
        return response()->json($data);
    }
}
