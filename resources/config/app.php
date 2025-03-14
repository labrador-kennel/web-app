<?php declare(strict_types=1);

$hasTlsCert = file_exists(dirname(__DIR__) . '/certs/tls.pem');

return [
    'templateDir' => dirname(__DIR__) . '/templates',
    'staticAssetDir' => dirname(__DIR__) . '/assets',
    'staticAssetUrlPrefix' => 'assets',
    'routesConfigFile' => __DIR__ . '/routes.php',
];