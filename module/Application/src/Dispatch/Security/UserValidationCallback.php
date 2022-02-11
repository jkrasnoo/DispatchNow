<?php

declare(strict_types=1);

namespace Application\Dispatch\Security;

class UserValidationCallback
{
    public function __invoke(string $hash, string $password) : bool
    {
        return password_verify($password, $hash);
    }
}