<?php declare(strict_types=1);

return [
    'totalConnectionLimit' => 1000,
    'connectionLimitPerClient' => 10,
    'tlsCertificatePath' => dirname(__DIR__) . '/certs/tls.pem',
    'httpPort' => 80,
    'httpsPort' => 443
];