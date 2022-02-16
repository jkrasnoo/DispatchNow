<?php

declare(strict_types=1);

namespace Application\Dispatch\Model;

use Laminas\Db\Adapter\Adapter;

class RegisterUser
{
    private Adapter $writeDbAdapter;

    function __construct(Adapeter $writeDbAdapter)
    {
        $this->writeDbAdapter = $writeDbAdapter;
    }


}