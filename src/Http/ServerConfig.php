<?php declare(strict_types=1);

namespace App\Http;

use Amp\Socket\InternetAddress;
use Cspray\AnnotatedContainer\Attribute\Inject;
use Cspray\AnnotatedContainer\Attribute\Service;
use Labrador\Web\Server\HttpServerSettings;
use Override;

#[Service]
final readonly class ServerConfig implements HttpServerSettings {

    /**
     * @param int<1, max> $totalConnectionLimit
     * @param int<1, max> $connectionLimitPerClient
     * @param int<0, 65535> $httpPort
     * @param int<0, 65535> $httpsPort
     * @param string $tlsCertificatePath
     */
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

    #[Override]
    public function unencryptedInternetAddresses() : array {
        return [
            new InternetAddress('0.0.0.0', $this->httpPort)
        ];
    }

    #[Override]
    public function encryptedInternetAddresses() : array {
        return [
            new InternetAddress('0.0.0.0', $this->httpsPort)
        ];
    }

    #[Override]
    public function tlsCertificateFile() : ?string {
        return $this->tlsCertificatePath;
    }

    #[Override]
    public function totalClientConnectionLimit() : int {
        return $this->totalConnectionLimit;
    }

    #[Override]
    public function clientConnectionLimitPerIpAddress() : int {
        return $this->connectionLimitPerClient;
    }
}