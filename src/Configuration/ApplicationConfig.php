<?php declare(strict_types=1);

namespace App\Configuration;

use Cspray\AnnotatedContainer\Attribute\Inject;
use Cspray\AnnotatedContainer\Attribute\Service;

#[Service]
final readonly class ApplicationConfig {

    public function __construct(
        #[Inject('app.templateDir', from: 'config')]
        public string $templateDir,

        #[Inject('app.staticAssetDir', from: 'config')]
        public string $staticAssetDir,

        #[Inject('app.autoRedirectHttps', from: 'config')]
        public bool $autoRedirectHttps,

        #[Inject('app.autoRedirectHttpsPort', from: 'config')]
        public ?int $autoRedirectHttpsPort
    ) {}

}
