<?php declare(strict_types=1);

namespace App\Template;

use App\ApplicationConfig;
use Cspray\AnnotatedContainer\Attribute\ServiceDelegate;
use League\Plates\Engine;

final class TemplateEngineFactory {

    private function __construct() {}

    #[ServiceDelegate]
    public static function createTemplates(ApplicationConfig $config) : Engine {
        $engine = new Engine();

        $engine->addFolder('layouts', $config->templateDir . '/layouts');
        $engine->addFolder('pages', $config->templateDir . '/pages');
        $engine->addFolder('components', $config->templateDir . '/components');

        return $engine;
    }

}