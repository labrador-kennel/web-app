<?php declare(strict_types=1);

namespace App\Configuration;

use Amp\Http\Cookie\CookieAttributes;
use Amp\Http\Server\Session\LocalSessionStorage;
use Amp\Http\Server\Session\SessionFactory;
use Amp\Http\Server\Session\SessionMiddleware;
use Amp\Sync\LocalKeyedMutex;
use Cspray\AnnotatedContainer\Attribute\Service;
use Labrador\Web\Application\ApplicationSettings;
use Labrador\Web\Application\StaticAssetSettings;

#[Service(primary: true)]
final readonly class LabradorConfig implements ApplicationSettings {

    public function __construct(
        private ApplicationConfig $config
    ) {}

    public function getSessionMiddleware() : ?SessionMiddleware {
        return new SessionMiddleware(
            new SessionFactory(
                new LocalKeyedMutex(),
                new LocalSessionStorage(),
            ),
            CookieAttributes::default()->withPath('/')
        );
    }

    public function getStaticAssetSettings() : ?StaticAssetSettings {
        return new StaticAssetSettings(
            $this->config->staticAssetDir,
            $this->config->staticAssetUrlPrefix
        );
    }

}