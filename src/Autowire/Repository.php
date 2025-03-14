<?php declare(strict_types=1);

namespace App\Autowire;

use Cspray\AnnotatedContainer\Attribute\ServiceAttribute;

#[\Attribute(\Attribute::TARGET_CLASS)]
final class Repository implements ServiceAttribute {

    public function __construct(
        private readonly array $profiles = []
    ) {}

    public function profiles() : array {
        return $this->profiles;
    }

    public function isPrimary() : bool {
        return false;
    }

    public function name() : ?string {
        return null;
    }
}