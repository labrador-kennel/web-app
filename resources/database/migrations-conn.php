<?php declare(strict_types=1);

use Doctrine\DBAL\DriverManager;

$profiles = getenv('PROFILES');
if ($profiles === false) {
    throw new RuntimeException(
        'You MUST provide a comma-separated list of profiles to use when running migrations.'
    );
}
$profiles = (new \Cspray\AnnotatedContainer\Profiles\CsvActiveProfilesParser())->parse($profiles);

$container = (new \App\ContainerBootstrap(new \Psr\Log\NullLogger()))->createContainerBootstrap($profiles)->bootstrapContainer($profiles);
$dbConfig = $container->get(\App\Configuration\DatabaseConfig::class);

assert($dbConfig instanceof \App\Configuration\DatabaseConfig);

$connection = DriverManager::getConnection([
    'dbname' => $dbConfig->database,
    'user' => $dbConfig->user,
    'password' => $dbConfig->password,
    'host' => $dbConfig->host,
    'driver' => 'pgsql',
]);
$connection->executeQuery(sprintf('SET search_path TO %s', $dbConfig->schema));
return $connection;