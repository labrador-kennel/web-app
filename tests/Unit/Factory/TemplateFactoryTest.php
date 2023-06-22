<?php declare(strict_types=1);

namespace App\Tests\Unit\Factory;

use App\Configuration\ApplicationConfig;
use App\Factory\TemplateFactory;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[
    CoversClass(TemplateFactory::class),
    CoversClass(ApplicationConfig::class)
]
final class TemplateFactoryTest extends TestCase {

    private ApplicationConfig $config;

    protected function setUp() : void {
        $this->config = new ApplicationConfig(
            dirname(__DIR__, 3) . '/resources/templates',
            dirname(__DIR__, 3) . '/resources/assets',
            true,
            9118
        );
    }

    public function testPlatesEngineHasLayoutsFolder() : void {
        $subject = TemplateFactory::createTemplates($this->config);

        $folders = $subject->getFolders();

        self::assertTrue($folders->exists('layouts'));
    }

    public function testPlatesEngineHasComponentsFolder() : void {
        $subject = TemplateFactory::createTemplates($this->config);

        $folders = $subject->getFolders();

        self::assertTrue($folders->exists('components'));
    }

    public function testPlatesEngineHasPagesFolder() : void {
        $subject = TemplateFactory::createTemplates($this->config);

        $folders = $subject->getFolders();

        self::assertTrue($folders->exists('pages'));
    }

    public function testPlatesEngineHasCorrectLayoutsPaths() : void {
        $subject = TemplateFactory::createTemplates($this->config);

        $folders = $subject->getFolders();

        self::assertSame(
            $this->config->templateDir . '/layouts',
            $folders->get('layouts')->getPath()
        );
    }

    public function testPlatesEngineHasCorrectComponentsPaths() : void {
        $subject = TemplateFactory::createTemplates($this->config);

        $folders = $subject->getFolders();

        self::assertSame(
            $this->config->templateDir . '/components',
            $folders->get('components')->getPath()
        );
    }

    public function testPlatesEngineHasCorrectPagesPaths() : void {
        $subject = TemplateFactory::createTemplates($this->config);

        $folders = $subject->getFolders();

        self::assertSame(
            $this->config->templateDir . '/pages',
            $folders->get('pages')->getPath()
        );
    }

}
