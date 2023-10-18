<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class DataStructureServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // require_once app_path() . '/Helpers/DataStructure.php';
        parent::register("DataStructure");
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
