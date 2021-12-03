<?php

namespace Ospedale\Auth\Domain\Services;

class AuthService
{
    protected $auth;

    public function __construct()
    {
        $this->auth = auth();
    }

    public function logout(): bool
    {
        $this->auth->logout();
        return true;
    }

    public function refresh()
    {
        throw new \DomainException("Method without Implementation");
    }

    /**
     * Get the authenticated User.
     */
    public function me(): ?Authenticatable
    {
        return $this->auth->user();
    }

    /**
     * Get a JWT via given credentials.
     */

    public function login(array $credentials = null)
    {
        // Try log in using credentials
        if (!$token = $this->auth->attempt($credentials)) {
            throw new \DomainException("Invalid Credentials", "401");
        }

        //Return Token
        return $token;
    }
}
