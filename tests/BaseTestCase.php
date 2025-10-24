<?php

namespace McGo\Query\Tests;

use McGo\Query\Query;
use McGo\Query\Tests\Mock\Builder\MockedModelQueryBuilder;
use McGo\Query\Tests\Mock\Models\MockedModel;
use Orchestra\Testbench\TestCase;

class BaseTestCase  extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        // 1) Test-Migrationen laden
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

        // Alternativ (äquivalent):
        // $this->artisan('migrate', ['--database' => 'testbench'])->run();
    }

    protected function getEnvironmentSetUp($app): void
    {
        // In-Memory SQLite für schnelle, isolierte Tests
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
    }
    protected function writeTests()
    {
        $this->assertTrue(false, 'Test has to be written!');
    }

    public function getMockedQueryResultWithArray(array $array)
    {
        return $this->getMockedQueryBuilderWithArray($array)->get();
    }
    public function getMockedQueryBuilderWithArray(array $array)
    {
        return Query::theModel(MockedModel::class)
            ->withBuilder(MockedModelQueryBuilder::class)
            ->forArray($array)
            ->getBuilder();

    }
}