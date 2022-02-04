<?php
    namespace QR_Maneger\Test;

    use Orchestra\Testbench\TestCase as BaseTestCase;

    class TestCase extends BaseTestCase {

        protected function setUp(): void {
            parent::setUp();

            $path = dirname(dirname(__DIR__));

            $this->loadMigrationsFrom($path. '/database/migrations');

            $this->withFactories($path. '/database/factories');

            $this->artisan('migrate')->run();
        }

        protected function getEnvironmentSetUp($app){
            $app['config']->set('database.connections.mysql', [
                'driver' => 'mysql',
                'host' => 'db-dl',
                'port' => '3306',
                'database' => 'sample_db_test',
                'username' => 'root',
                'password' => 'root',
                'charset' => 'utf8mb4',
                'collation' => 'utf8mb4_unicode_ci',
                'prefix' => '',
                'prefix_indexes' => true,
                'strict' => true,
                'engine' => null,
            ]);
        }

    }
