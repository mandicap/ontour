<?php

namespace Tests;

use Exception;
use Faker\Factory;
use Faker\Generator;
use Illuminate\Support\Facades\Artisan;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use DatabaseMigrations;

    private Generator $faker;

    /**
     * Creates the application.
     *
     * @return \Laravel\Lumen\Application
     */
    public function createApplication()
    {
        return require __DIR__.'/../bootstrap/app.php';
    }

    public function setUp() : void
    {
        parent::setUp();

        $this->faker = Factory::create();

        Artisan::call('migrate:refresh');
    }

    public function __get($key)
    {
        if ($key === 'faker') {
            return $this->faker;
        }

        throw new Exception('Unknown key requested.');
    }
}
