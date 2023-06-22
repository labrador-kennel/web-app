<?php declare(strict_types=1);

namespace App\Tests;

use Cspray\AnnotatedContainer\Attribute\Service;
use Labrador\Logging\LoggerFactory;
use Labrador\Logging\LoggerType;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

class NullLoggerFactory implements LoggerFactory {

    public function createLogger(LoggerType $loggerType) : LoggerInterface {
        return new NullLogger();
    }
}