<?php

namespace CustomD\Sso;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class ServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name("customd-sso")
            ->hasRoute('web');
    }

    public function packageRegistered()
    {
        $this->publishes([
            __DIR__ . '/../stubs/SSOUser.php' => app_path('Actions/CustomD/SSOUser.php'),
        ], 'customd-sso-support');
    }
}
