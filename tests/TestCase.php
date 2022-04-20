<?php

namespace Tests;

use Faker\Factory;
use Faker\Generator as FakerGenerator;
use Laravel\Lumen\Application;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Laravel\Lumen\Testing\TestCase as BaseTestCase;

/**
 * Class TestCase.
 */
abstract class TestCase extends BaseTestCase
{
    use DatabaseTransactions;

    /**
     * Creates the application.
     *
     * @return Application
     */
    public function createApplication()
    {
        return require __DIR__ . '/../bootstrap/app.php';
    }

    /**
     * Create a Faker instance for the given locale.
     *
     * @param  string|null  $locale
     *
     * @return FakerGenerator
     */
    protected function makeFaker(?string $locale = null): FakerGenerator
    {
        return Factory::create($locale ?? Factory::DEFAULT_LOCALE);
    }
}
