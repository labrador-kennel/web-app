<?php declare(strict_types=1);

namespace App;

use App\Factory\LoggerFactory;
use Cspray\AnnotatedContainer\Bootstrap\Bootstrap;
use Cspray\AnnotatedContainer\Bootstrap\DefaultParameterStoreFactory;
use Cspray\AnnotatedContainer\Bootstrap\DelegatedParameterStoreFactory;
use Cspray\AnnotatedContainer\Secrets\ConfigParameterStoreFactory;
use Cspray\AnnotatedContainer\Secrets\IdentifierSourceMap;
use Cspray\AnnotatedContainer\Secrets\PhpIncludeValueProvider;
use Cspray\AnnotatedContainer\Secrets\ProfileAwareSource;
use Cspray\AnnotatedContainer\Secrets\SingleValueProviderSource;
use Psr\Log\LoggerInterface;

final readonly class ContainerBootstrap {

    private LoggerInterface $logger;

    public function __construct(
        LoggerInterface $logger = null
    ) {
        if ($logger === null) {
            $logger = LoggerFactory::createLogger();
        }

        $this->logger = $logger;
    }

    public function createContainerBootstrap(array $profiles) : Bootstrap {
        $configDir = dirname(__DIR__) . '/resources/config';
        $factory = new ConfigParameterStoreFactory(
            (new IdentifierSourceMap())
                ->withIdentifierAndSources('config', [
                    new ProfileAwareSource('database', $profiles, [
                        'dev' => new PhpIncludeValueProvider($configDir . '/database.dev.php'),
                        'unit-test' => new PhpIncludeValueProvider($configDir . '/database.test.php'),
                        'prod' => new PhpIncludeValueProvider($configDir . '/database.prod.php')
                    ]),
                    new SingleValueProviderSource('app', new PhpIncludeValueProvider($configDir . '/app.php')),
                    new SingleValueProviderSource('server', new PhpIncludeValueProvider($configDir . '/server.php'))
                ])
        );
        $parameterStoreFactory = new DelegatedParameterStoreFactory(new DefaultParameterStoreFactory());
        $parameterStoreFactory->addParameterStoreFactory('config', $factory);

        return new Bootstrap(
            logger: $this->logger,
            parameterStoreFactory: $parameterStoreFactory
        );
    }

}