<?php

declare(strict_types=1);

namespace Application\Dispatch\Security;

class UserPasswordHash
{
    public function __invoke(string $password) : string
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }
}