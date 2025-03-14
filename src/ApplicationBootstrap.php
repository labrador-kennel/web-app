<?php declare(strict_types=1);

namespace App;

use Cspray\AnnotatedContainer\AnnotatedContainer;
use Cspray\AnnotatedContainer\Bootstrap\Bootstrap;
use Cspray\AnnotatedContainer\Bootstrap\DefaultParameterStoreFactory;
use Cspray\AnnotatedContainer\Bootstrap\DelegatedParameterStoreFactory;
use Cspray\AnnotatedContainer\ContainerFactory\PhpDiContainerFactory;
use Cspray\AnnotatedContainer\Event\Emitter;
use Cspray\AnnotatedContainer\Profiles;
use Cspray\AnnotatedContainer\Secrets\ConfigParameterStoreFactory;
use Cspray\AnnotatedContainer\Secrets\IdentifierSourceMap;
use Cspray\AnnotatedContainer\Secrets\PhpIncludeValueProvider;
use Cspray\AnnotatedContainer\Secrets\ProfileAwareSource;
use Cspray\AnnotatedContainer\Secrets\SingleValueProviderSource;
use Labrador\AsyncEvent\Autowire\RegisterAutowiredListener;
use Labrador\Web\Autowire\RegisterControllerListener;

final readonly class ApplicationBootstrap {

    public function __construct() {}

    public function bootstrapContainer(Profiles $profiles) : AnnotatedContainer {
        $configDir = dirname(__DIR__) . '/resources/config';
        $emitter = new Emitter();
        $emitter->addListener(new RegisterControllerListener());
        $emitter->addListener(new RegisterAutowiredListener());
        $factory = new ConfigParameterStoreFactory(
            (new IdentifierSourceMap())
                ->withIdentifierAndSources('config', [
                    new ProfileAwareSource('database', $profiles->toArray(), [
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

        return Bootstrap::fromAnnotatedContainerConventions(
            new PhpDiContainerFactory($emitter),
            $emitter,
            parameterStoreFactory: $parameterStoreFactory
        )->bootstrapContainer($profiles);
    }

}