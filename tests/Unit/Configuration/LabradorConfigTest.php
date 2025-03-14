<?php declare(strict_types=1);

namespace App\Tests\Unit\Configuration;

use App\Configuration\ApplicationConfig;
use App\Configuration\LabradorConfig;
use Labrador\AsyncEvent\AmpEmitter;
use Labrador\AsyncEvent\Emitter;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[
    CoversClass(LabradorConfig::class),
    CoversClass(ApplicationConfig::class)
]
final class LabradorConfigTest extends TestCase {


    private LabradorConfig $subject;

    protected function setUp() : void {
        $applicationConfig = new ApplicationConfig(
            'template-dir',
            'static-asset-dir',
            'assets'
        );
        $this->subject = new LabradorConfig($applicationConfig);
    }

    public function testGetStaticAssetDirectory() : void {
        $settings = $this->subject->getStaticAssetSettings();

        self::assertNotNull($settings);
        self::assertSame('static-asset-dir', $settings->assetDir);
        self::assertSame('assets', $settings->pathPrefix);
    }

    public function testGetSessionMiddleware() : void {
        self::assertNotNull($this->subject->getSessionMiddleware());
    }

    public function testGetAmpEmitter() : void {
        self::assertInstanceOf(Emitter::class, new AmpEmitter());
    }

}