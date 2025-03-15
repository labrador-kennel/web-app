<?php declare(strict_types=1);

namespace App\Http;

use Amp\Socket\InternetAddress;
use Cspray\AnnotatedContainer\Attribute\Inject;
use Cspray\AnnotatedContainer\Attribute\Service;
use Labrador\Web\Server\HttpServerSettings;

#[Service]
final readonly class ServerConfig implements HttpServerSettings {

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

    public function unencryptedInternetAddresses() : array {
        return [
            new InternetAddress('0.0.0.0', $this->httpPort)
        ];
    }

    public function encryptedInternetAddresses() : array {
        return [
            new InternetAddress('0.0.0.0', $this->httpsPort)
        ];
    }

    public function tlsCertificateFile() : ?string {
        return $this->tlsCertificatePath;
    }

    public function totalClientConnectionLimit() : int {
        return $this->totalConnectionLimit;
    }

    public function clientConnectionLimitPerIpAddress() : int {
        return $this->connectionLimitPerClient;
    }
}