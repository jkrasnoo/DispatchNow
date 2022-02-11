<?php

declare(strict_types=1);

namespace Application\Db\Sql;

abstract class AbstractDbSql
{
    public abstract function __invoke();
}