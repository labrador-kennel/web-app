<?php declare(strict_types=1);

namespace App;

use Amp\Http\Cookie\CookieAttributes;
use Amp\Http\Server\Session\LocalSessionStorage;
use Amp\Http\Server\Session\SessionFactory;
use Amp\Http\Server\Session\SessionMiddleware;
use Amp\Sync\LocalKeyedMutex;
use Cspray\AnnotatedContainer\Attribute\Inject;
use Cspray\AnnotatedContainer\Attribute\Service;
use Labrador\Web\Application\ApplicationSettings;
use Labrador\Web\Application\StaticAssetSettings;
use Override;

#[Service(primary: true)]
final readonly class ApplicationConfig implements ApplicationSettings {

    public function __construct(
        #[Inject('app.templateDir', from: 'config')]
        public string $templateDir,

        #[Inject('app.staticAssetDir', from: 'config')]
        public string $staticAssetDir,

        #[Inject('app.staticAssetUrlPrefix', from: 'config')]
        public string $staticAssetUrlPrefix
    ) {}

    #[Override]
    public function getSessionMiddleware() : ?SessionMiddleware {
        return new SessionMiddleware(
            new SessionFactory(
                new LocalKeyedMutex(),
                new LocalSessionStorage(),
            ),
            CookieAttributes::default()->withPath('/')
        );
    }

    #[Override]
    public function getStaticAssetSettings() : ?StaticAssetSettings {
        return new StaticAssetSettings(
            $this->staticAssetDir,
            $this->staticAssetUrlPrefix
        );
    }
}
