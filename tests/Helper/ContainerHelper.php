<?php declare(strict_types=1);

namespace App\Tests\Helper;

use App\ContainerBootstrap;
use Cspray\AnnotatedContainer\AnnotatedContainer;
use Cspray\AnnotatedContainer\Profiles\ActiveProfiles;
use Psr\Log\NullLogger;

final class ContainerHelper {

    private function __construct() {}

    public static function bootstrapTestContainer(array $profiles) : AnnotatedContainer {
        return (new ContainerBootstrap(new NullLogger()))->createContainerBootstrap($profiles)->bootstrapContainer($profiles);
    }

    public static function activeProfiles(array $profiles) : ActiveProfiles {
        return new class($profiles) implements ActiveProfiles {

            public function __construct(
                private readonly array $profiles
            ) {}

            public function getProfiles() : array {
                return $this->profiles;
            }

            public function isActive(string $profile) : bool {
                return in_array($profile, $this->profiles, true);
            }
        };
    }

}