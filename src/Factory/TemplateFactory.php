<?php declare(strict_types=1);

namespace App\Factory;

use Cspray\AnnotatedContainer\Attribute\ServiceDelegate;
use League\Plates\Engine;

final class TemplateFactory {

    private function __construct() {}

    #[ServiceDelegate]
    public static function createTemplates() : Engine {
        $engine = new Engine();

        $engine->addFolder(
            'layout',
            dirname(__DIR__, 2) . '/resources/templates/layouts'
        );

        $engine->setDirectory(dirname(__DIR__, 2) . '/resources/templates');

        return $engine;
    }

}