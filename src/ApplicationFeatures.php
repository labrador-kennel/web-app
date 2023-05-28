<?php declare(strict_types=1);

namespace App;

use Amp\Http\Server\Session\SessionMiddleware;
use Cspray\AnnotatedContainer\Attribute\Service;
use Labrador\Web\Application\ApplicationFeatures as LabradorAppFeatures;
use Labrador\Web\Application\StaticAssetSettings;

#[Service(primary: true)]
final class ApplicationFeatures implements LabradorAppFeatures {

    public function getSessionMiddleware() : ?SessionMiddleware {
        return null;
    }

    public function autoRedirectHttpToHttps() : bool {
        return false;
    }

    public function getStaticAssetSettings() : ?StaticAssetSettings {
        return new StaticAssetSettings(dirname(__DIR__) . '/resources/assets');
    }
}