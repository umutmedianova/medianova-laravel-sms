<?php
namespace Medianova\LaravelSms\Test;

use Medianova\LaravelSms\Facades\Sms;
use Medianova\LaravelSms\LaravelSmsServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

class TestCase extends OrchestraTestCase
{
    /**
     * Load package service provider
     * @param  \Illuminate\Foundation\Application $app
     * @return Medianova\LaravelSms\LaravelSmsServiceProvider
     */
    protected function getPackageProviders($app)
    {
        return [LaravelSmsServiceProvider::class];
    }
    /**
     * Load package alias
     * @param  \Illuminate\Foundation\Application $app
     * @return array
     */
    protected function getPackageAliases($app)
    {
        return [
            'sms' => Sms::class,
        ];
    }
}
