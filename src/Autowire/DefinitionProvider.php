<?php declare(strict_types=1);

namespace App\Autowire;

use Amp\Postgres\PostgresLink;
use Cspray\AnnotatedContainer\StaticAnalysis\DefinitionProvider as AnnotatedContainerDefinitionProvider;
use Cspray\AnnotatedContainer\StaticAnalysis\DefinitionProviderContext;
use League\Plates\Engine;
use Psr\Log\LoggerInterface;
use function Cspray\AnnotatedContainer\Definition\service;
use function Cspray\AnnotatedContainer\Reflection\types;

final class DefinitionProvider implements AnnotatedContainerDefinitionProvider {

    public function consume(DefinitionProviderContext $context) : void {
        $context->addServiceDefinition(service(types()->class(Engine::class)));
        $context->addServiceDefinition(service(types()->class(LoggerInterface::class)));
        $context->addServiceDefinition(service(types()->class(PostgresLink::class)));
    }

}
