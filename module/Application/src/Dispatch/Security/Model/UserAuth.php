<?php

declare(strict_types=1);

namespace Application\Dispatch\Security\Model;

use Laminas\Authentication\Adapter\DbTable\CallbackCheckAdapter as AuthAdapter;
use Application\Dispatch\Security\UserValidationCallback;

class UserAuth
{
    const TABLE_NAME        = 'user_management';
    const IDENTITY_COLUMN   = 'user_email';
    const CREDENTIAL_COLUMN = 'authentication_string';

    private AuthAdapter $adapter;

    public function __construct(UserValidationCallback $userValidationCallback, $dbAdapter)
    {
        $this->adapter = new AuthAdapter(
            $dbAdapter,
            self::TABLE_NAME,
            self::IDENTITY_COLUMN,
            self::CREDENTIAL_COLUMN,
            $userValidationCallback
        );
    }

    public function setIdentity(string $identity) : UserAuth
    {
        $this->adapter->setIdentity($identity);

        return $this;
    }

    public function setCredential(string $credential) : UserAuth
    {
        $this->adapter->getCredential($credential);

        return $this;
    }
}