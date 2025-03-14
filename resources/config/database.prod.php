<?php declare(strict_types=1);

use Amp\Sql\Common\SqlCommonConnectionPool;

return [
    'database' => 'postgres',
    'schema' => 'web_app',
    'host' => '',
    'port' => 5432,
    'user' => '',
    'password' => '',
    'poolConnectionLimit' => SqlCommonConnectionPool::DEFAULT_MAX_CONNECTIONS,
];