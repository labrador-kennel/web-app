<?php declare(strict_types=1);

namespace App\Home\Controller;

use Labrador\Template\TemplateData;

final class HomeTemplateData implements TemplateData {

    /**
     * @var list<array{
     *     title: string,
     *     description: string,
     *     tabs: list<array{name: string, path: string}>
     * }>
     */
    public readonly array $features;

    public function __construct() {
        $this->features = [
            [
                'title' => 'Controllers & Routing',
                'description' => 'Controllers are routed using attributes',
                'tabs' => [
                    [
                        'name' => 'Attribute Routing',
                        'path' => '/assets/img/pages/home/routing-attributes.png'
                    ],
                    [
                        'name' => 'Configuration Routing',
                        'path' => '/assets/img/pages/home/routing-configuration.png'
                    ],
                    [
                        'name' => 'Event Listener Routing',
                        'path' => '/assets/img/pages/home/routing-event-listener.png'
                    ]
                ]
            ],
            [
                'title' => 'Templates',
                'description' => 'Templating provided by league/plates',
                'tabs' => [
                    [
                        'name' => 'Layouts',
                        'path' => '/assets/img/pages/home/templates-layouts.png'
                    ],
                    [
                        'name' => 'Components',
                        'path' => '/assets/img/pages/home/templates-components.png'
                    ]
                ]
            ],
            [
                'title' => 'Configuration',
                'description' => 'Configuration powered by cspray/annotated-container-secrets',
                'tabs' => [
                    [
                        'name' => 'Example',
                        'path' => '/assets/img/pages/home/configuration-example.png'
                    ]
                ]
            ],
            [
                'title' => 'PostgreSQL Database',
                'description' => 'Database stuff powered by postgres',
                'tabs' => [
                    [
                        'name' => 'Example',
                        'path' => '/assets/img/pages/home/database-example.png'
                    ]
                ]
            ],
            [
                'title' => 'Docker',
                'description' => 'App runs on production-ready Docker image',
                'tabs' => [
                    [
                        'name' => 'Example',
                        'path' => '/assets/img/pages/home/docker-example.png'
                    ]
                ]
            ],
            [
                'title' => 'Just Command Runner',
                'description' => 'Use just to run common commands',
                'tabs' => [
                    [
                        'name' => 'Example',
                        'path' => '/assets/img/pages/home/just-example.png'
                    ]
                ]
            ]
        ];
    }

}