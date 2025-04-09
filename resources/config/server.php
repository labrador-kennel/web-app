<?php declare(strict_types=1);

return [
    'totalConnectionLimit' => 1000,
    'connectionLimitPerClient' => 10,
    'tlsCertificatePath' => dirname(__DIR__) . '/certs/tls.pem',
    'tlsKeyPath' => dirname(__DIR__) . '/certs/tls-key.pem',
    'httpPort' => 80,
    'httpsPort' => 443
];