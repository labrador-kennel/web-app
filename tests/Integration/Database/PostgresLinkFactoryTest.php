<?php declare(strict_types=1);

namespace App\Tests\Integration\Database;

use Amp\Postgres\PostgresLink;
use App\Database\DatabaseConfig;
use App\Database\PostgresLinkFactory;
use App\Tests\DatabaseTestCase;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(PostgresLinkFactory::class)]
#[CoversClass(DatabaseConfig::class)]
final class PostgresLinkFactoryTest extends DatabaseTestCase {

    public function testPostgresLinkHasCorrectSchemaSet() : void {
        $config = new DatabaseConfig(
            'postgres',
            'web_app_test',
            'database',
            5432,
            'postgres',
            'password',
            1
        );
        $postgres = PostgresLinkFactory::createPostgresLink($config);

        self::assertInstanceOf(PostgresLink::class, $postgres);
        self::assertSame(
            'web_app_test',
            $postgres->query('SHOW search_path')->fetchRow()['search_path']
        );
    }


}