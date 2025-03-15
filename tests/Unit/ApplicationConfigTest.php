<?php declare(strict_types=1);

namespace App\Tests\Unit;

use App\ApplicationConfig;
use Labrador\AsyncEvent\AmpEmitter;
use Labrador\AsyncEvent\Emitter;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(ApplicationConfig::class)]
final class ApplicationConfigTest extends TestCase {


    private ApplicationConfig $subject;

    protected function setUp() : void {
        $this->subject = new ApplicationConfig(
            'template-dir',
            'static-asset-dir',
            'assets'
        );
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

}