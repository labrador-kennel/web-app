<?php declare(strict_types=1);

use Cspray\AnnotatedContainer\Bootstrap\Bootstrap;
use Psr\Log\LoggerInterface;

return static function(LoggerInterface $logger) {
    $bootstrap = new Bootstrap(logger: $logger);

    return $bootstrap;
};