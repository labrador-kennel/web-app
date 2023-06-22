<?php declare(strict_types=1);

namespace App\Tests\Unit\Autowire;

use Amp\Postgres\PostgresLink;
use App\Autowire\DefinitionProvider;
use Cspray\AnnotatedContainer\Definition\ContainerDefinitionBuilder;
use Cspray\AnnotatedContainer\StaticAnalysis\DefinitionProviderContext;
use League\Plates\Engine;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;

#[CoversClass(DefinitionProvider::class)]
final class DefinitionProviderTest extends TestCase {

    private function definitionProviderContext() : DefinitionProviderContext {
        return new class implements DefinitionProviderContext {

            private ContainerDefinitionBuilder $builder;

            public function __construct() {
                $this->setBuilder(ContainerDefinitionBuilder::newDefinition());
            }
            public function getBuilder() : ContainerDefinitionBuilder {
                return $this->builder;
            }

            public function setBuilder(ContainerDefinitionBuilder $containerDefinitionBuilder) : void {
                $this->builder = $containerDefinitionBuilder;
            }
        };
    }

    public function testCorrectServicesAddedToContainerDefinitionBuilder() : void {
        $subject = new DefinitionProvider();
        $context = $this->definitionProviderContext();

        $subject->consume($context);

        $serviceDefinitions = $context->getBuilder()->getServiceDefinitions();

        self::assertCount(3, $serviceDefinitions);

        self::assertSame(Engine::class, $serviceDefinitions[0]->getType()->getName());
        self::assertSame(LoggerInterface::class, $serviceDefinitions[1]->getType()->getName());
        self::assertSame(PostgresLink::class, $serviceDefinitions[2]->getType()->getName());
    }

}
