<?php declare(strict_types=1);

namespace App\Tests\Unit\Configuration;

use App\Configuration\ApplicationConfig;
use App\Configuration\LabradorConfig;
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
            true,
            9118
        );
        $this->subject = new LabradorConfig($applicationConfig);
    }

    public function testGetStaticAssetDirectory() : void {
        $settings = $this->subject->getStaticAssetSettings();

        self::assertNotNull($settings);
        self::assertSame('static-asset-dir', $settings->assetDir);
        self::assertSame('assets', $settings->pathPrefix);
    }

    public function testGetAutoRedirectToHttps() : void {
        self::assertTrue($this->subject->autoRedirectHttpToHttps());
    }

    public function testGetAutoRedirectHttpsPort() : void {
        self::assertSame(9118, $this->subject->getHttpsRedirectPort());
    }

    public function testGetSessionMiddleware() : void {
        self::assertNotNull($this->subject->getSessionMiddleware());
    }

}