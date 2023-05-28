<?php declare(strict_types=1);

namespace App\Http;

use Amp\Socket\InternetAddress;
use Cspray\AnnotatedContainer\Attribute\Service;
use Labrador\Web\Server\HttpServerConfiguration;

#[Service]
final class ServerConfiguration implements HttpServerConfiguration {

    public function getUnencryptedInternetAddresses() : array {
        return [
            new InternetAddress('0.0.0.0', 80)
        ];
    }

    public function getEncryptedInternetAddresses() : array {
        return [];
    }

    public function getTlsCertificateFile() : ?string {
        return null;
    }

    public function getTotalClientConnectionLimit() : int {
        return 1000;
    }

    public function getClientConnectionLimitPerIpAddress() : int {
        return 10;
    }
}