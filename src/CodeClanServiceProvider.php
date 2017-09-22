<?php

namespace CodeClan\Domain;

use Illuminate\Support\ServiceProvider;

class CodeClanServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // include __DIR__ . "/routes.php";

        // $this->loadViewsFrom(__DIR__ . "/Views", "domain");
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // $this->app->singleton("domain", function () {
        //     return new Domain();
        // });

        $this->registerConfigs();

        if ($this->app->runningInConsole()) {
            $this->registerPublishableResources();
        }
    }

    public function registerConfigs()
    {
        $this->mergeConfigFrom(
            dirname(__DIR__).'/publishable/config/codeclan.php', 'codeclan'
        );
    }

    private function registerPublishableResources()
    {
        $publishablePath = dirname(__DIR__).'/publishable';

        $publishable = [
            // 'migrations' => [
            //     "{$publishablePath}/database/migrations/" => database_path('migrations'),
            // ],
            // 'seeds' => [
            //     "{$publishablePath}/database/seeds/" => database_path('seeds'),
            // ],
            'config' => [
                "{$publishablePath}/config/codeclan.php" => config_path('codeclan.php'),
            ],
            // 'lang' => [
            //     "{$publishablePath}/lang/" => base_path('resources/lang/'),
            // ],
        ];

        foreach ($publishable as $group => $paths) {
            $this->publishes($paths, $group);
        }
    }
}
