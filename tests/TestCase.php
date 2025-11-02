<?php

namespace IslamAlsayed\LaravelToasts\Tests;

use IslamAlsayed\Toasts\ToastServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        // Additional setup if needed
    }

    protected function getPackageProviders($app)
    {
        return [
            ToastServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        // Setup default environment values
        $app['config']->set('toasts.move', 'enable');
        $app['config']->set('toasts.enter_time', '0.3s');
        $app['config']->set('toasts.exit_time', '0.3s');
        $app['config']->set('toasts.visible_time', '4s');
        $app['config']->set('toasts.start_delay_time', '0.5s');
        $app['config']->set('toasts.confirm.pin', true);
        $app['config']->set('toasts.default.dir', 'ltr');
        $app['config']->set('toasts.default.position', 'bottom');
        $app['config']->set('toasts.default.theme', 'info');
    }
}
