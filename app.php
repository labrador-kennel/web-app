<?php declare(strict_types=1);

use App\ContainerBootstrap;
use Cspray\AnnotatedContainer\Profiles\CsvActiveProfilesParser;
use Labrador\Web\Bootstrap as WebBootstrap;
use function Amp\trapSignal;

(static function() {
    require_once __DIR__ . '/vendor/autoload.php';

    $profiles = getenv('PROFILES');
    if (!is_string($profiles)) {
        throw new RuntimeException('An environment variable named PROFILES must be provided with a comma-separated list of active profiles.');
    }

    $profiles = (new CsvActiveProfilesParser())->parse($profiles);

    $app = (new WebBootstrap((new ContainerBootstrap())->createContainerBootstrap($profiles), $profiles))->bootstrapApplication();

    $app->start();

    trapSignal([SIGINT, SIGTERM]);

    $app->stop();
})();