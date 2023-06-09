<?php declare(strict_types=1);

namespace App\Tests\Unit\Configuration;

use Amp\Socket\SocketAddressType;
use App\Configuration\ServerConfig;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(ServerConfig::class)]
final class ServerConfigurationTest extends TestCase {

    private ServerConfig $subject;

    protected function setUp() : void {
        $this->subject = new ServerConfig(
            1000,
            10,
            80,
            443,
            __FILE__
        );
    }

    public function testTotalConnectionLimit() : void {
        self::assertSame(1000, $this->subject->getTotalClientConnectionLimit());
    }

    public function testConnectionLimitPerClient() : void {
        self::assertSame(10, $this->subject->getClientConnectionLimitPerIpAddress());
    }

    public function testUnencryptedInternetAddresses() : void {
        $addresses = $this->subject->getUnencryptedInternetAddresses();

        self::assertCount(1, $addresses);
        self::assertSame('0.0.0.0:80', $addresses[0]->toString());
        self::assertSame(SocketAddressType::Internet, $addresses[0]->getType());
    }

    public function testEncryptedInternetAddress() : void {
        $addresses = $this->subject->getEncryptedInternetAddresses();

        self::assertCount(1, $addresses);
        self::assertSame('0.0.0.0:443', $addresses[0]->toString());
        self::assertSame(SocketAddressType::Internet, $addresses[0]->getType());
    }

    public function testTlsCertificatePath() : void {
        self::assertSame(__FILE__, $this->subject->getTlsCertificateFile());
    }

}
