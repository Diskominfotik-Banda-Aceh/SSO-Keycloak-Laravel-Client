<?php

namespace DiskominfotikBandaAceh\SSOBandaAcehPHP;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Collection;
use Illuminate\Filesystem\Filesystem;

class SSOBandaAcehPHPServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'sso-banda-aceh-php');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'sso-banda-aceh-php');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadRoutesFrom(__DIR__.'/routes.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/sso-banda-aceh.php' => config_path('sso-banda-aceh.php'),
            ], 'config');

            // Publishing the views.
            $this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/sso-banda-aceh-php'),
            ], 'views');

            $this->publishes([
                __DIR__.'/../database/migrations/add_sso_at_users_table.php.stub' => $this->getMigrationFileName('add_sso_at_users_table.php'),
            ], 'migrations');

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/sso-banda-aceh-php'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/sso-banda-aceh-php'),
            ], 'lang');*/

            // Registering package commands.
            // $this->commands([]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/sso-banda-aceh.php', 'sso-banda-aceh');
        $this->mergeConfigFrom(__DIR__.'/../config/sso-banda-aceh-services.php', 'services');

        // Register the main class to use with the facade
        $this->app->singleton('sso-banda-aceh-php', function () {
            return new SSOBandaAcehPHP;
        });

        $this->app->register(EventServiceProvider::class);
    }

    protected function getMigrationFileName($migrationFileName): string
    {
        $timestamp = date('Y_m_d_His');

        $filesystem = $this->app->make(Filesystem::class);

        return Collection::make($this->app->databasePath().DIRECTORY_SEPARATOR.'migrations'.DIRECTORY_SEPARATOR)
            ->flatMap(function ($path) use ($filesystem, $migrationFileName) {
                return $filesystem->glob($path.'*_'.$migrationFileName);
            })
            ->push($this->app->databasePath()."/migrations/{$timestamp}_{$migrationFileName}")
            ->first();
    }
}
