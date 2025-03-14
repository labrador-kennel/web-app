<?php declare(strict_types=1);

namespace App\Factory;

use Amp\Log\ConsoleFormatter;
use Amp\Log\StreamHandler;
use Cspray\AnnotatedContainer\Attribute\Service;
use Cspray\AnnotatedContainer\Attribute\ServiceDelegate;
use Labrador\Logging\LoggerFactory;
use Monolog\Logger;
use Monolog\Processor\PsrLogMessageProcessor;
use Psr\Log\LoggerInterface;
use function Amp\ByteStream\getStdout;

#[Service]
final class ApplicationLoggerFactory implements LoggerFactory {

    private function __construct() {}

    public function createLogger() : LoggerInterface {
        $handler = new StreamHandler(getStdout());
        $handler->setFormatter(new ConsoleFormatter());

        return new Logger(
            'web-app',
            [$handler],
            [new PsrLogMessageProcessor()]
        );
    }

}