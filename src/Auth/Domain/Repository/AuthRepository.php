<?php

namespace Ospedale\Auth\Domain\Repository;

interface AuthRepository
{
    public function login(array $credentials = null);

    public function logout();

    public function refresh();

    public function me();
}
