<?php

namespace CustomD\Sso\Tests;

use CustomD\Sso\Facades\Sso;
use CustomD\Sso\ServiceProvider;
use Orchestra\Testbench\TestCase;

class SsoTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [ServiceProvider::class];
    }

    protected function getPackageAliases($app)
    {
        return [
            'sso' => Sso::class,
        ];
    }

    public function testExample()
    {
        $this->assertEquals(1, 1);
    }
}
