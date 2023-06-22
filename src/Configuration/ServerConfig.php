<?php declare(strict_types=1);

namespace App\Configuration;

use Amp\Socket\InternetAddress;
use Cspray\AnnotatedContainer\Attribute\Inject;
use Cspray\AnnotatedContainer\Attribute\Service;
use Labrador\Web\Server\HttpServerConfiguration;

#[Service]
final readonly class ServerConfig implements HttpServerConfiguration {

    public function __construct(
        #[Inject('server.totalConnectionLimit', from: 'config')]
        private int $totalConnectionLimit,

        #[Inject('server.connectionLimitPerClient', from: 'config')]
        private int $connectionLimitPerClient,

        #[Inject('server.httpPort', from: 'config')]
        private int $httpPort,

        #[Inject('server.httpsPort', from: 'config')]
        private int $httpsPort,

        #[Inject('server.tlsCertificatePath', from: 'config')]
        private string $tlsCertificatePath
    ) {}

    public function getUnencryptedInternetAddresses() : array {
        return [
            new InternetAddress('0.0.0.0', $this->httpPort)
        ];
    }

    public function getEncryptedInternetAddresses() : array {
        return [
            new InternetAddress('0.0.0.0', $this->httpsPort)
        ];
    }

    public function getTlsCertificateFile() : ?string {
        return $this->tlsCertificatePath;
    }

    public function getTotalClientConnectionLimit() : int {
        return $this->totalConnectionLimit;
    }

    public function getClientConnectionLimitPerIpAddress() : int {
        return $this->connectionLimitPerClient;
    }
}