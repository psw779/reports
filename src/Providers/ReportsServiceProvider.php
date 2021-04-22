<?php

namespace psw779\reports\Providers;

use Illuminate\Support\ServiceProvider;

class ReportsServiceProvider extends ServiceProvider {

    /**
     * Register services.
     *
     * @return void
     */
    public function register() {
        $this->mergeConfigFrom(__DIR__ . '/../../config/reports.php', 'reports');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot() {
        $this->loadRoutesFrom(__DIR__ . '/../../routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'reports');
    }

}
