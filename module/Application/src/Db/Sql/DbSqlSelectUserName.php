<?php

declare(strict_types=1);

namespace Application\Db\Sql;

use Application\Db\AbstractDbSql;

class DbSqlSelectUserName extends AbstractDbSql
{
    public function __invoke() : string
    {
        $sql = "SELECT user_email FROM user_management";
        return $sql;
    }
}