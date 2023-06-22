<?php declare(strict_types=1);

namespace App\Tests\Unit\Factory;

use Amp\Postgres\PostgresLink;
use App\Factory\PostgresLinkFactory;
use App\Tests\DatabaseTestCase;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(PostgresLinkFactory::class)]
final class PostgresLinkFactoryTest extends DatabaseTestCase {

    public function testPostgresLinkHasCorrectSchemaSet() : void {
        $postgres = $this->getContainer()->get(PostgresLink::class);

        self::assertInstanceOf(PostgresLink::class, $postgres);
        self::assertSame(
            'web_app_test',
            $postgres->query('SHOW search_path')->fetchRow()['search_path']
        );
    }


}