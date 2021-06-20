<?php

namespace KevinLbr\ForestAdminSchema\Providers;

use Illuminate\Support\ServiceProvider;
use KevinLbr\ForestAdminSchema\Commands\ScanCommand;

class SchemaServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                ScanCommand::class,
            ]);
        }
    }
}
