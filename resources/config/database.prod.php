<?php declare(strict_types=1);

use Amp\Sql\Common\ConnectionPool;

return [
    'database' => 'postgres',
    'schema' => 'web_app',
    'host' => '',
    'port' => 5432,
    'user' => '',
    'password' => '',
    'poolConnectionLimit' => ConnectionPool::DEFAULT_MAX_CONNECTIONS,
];