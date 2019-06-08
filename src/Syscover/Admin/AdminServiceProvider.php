<?php namespace Syscover\Admin;

use Illuminate\Support\ServiceProvider;
use Illuminate\Console\Scheduling\Schedule;
use Syscover\Admin\Services\CronService;

class AdminServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
        // register routes
        $this->loadRoutesFrom(__DIR__ . '/../../routes/api.php');

        // register translations
        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', 'admin');

        // register views
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'admin');

        // register migrations
        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');

        // register seeds
        $this->publishes([
            __DIR__ . '/../../database/seeds/' => base_path('/database/seeds')
        ], 'seeds');

        // register config
        $this->publishes([
            __DIR__ . '/../../config/pulsar-admin.php' => config_path('pulsar-admin.php')
        ], 'config');

        // register tests
        $this->publishes([
            __DIR__ . '/../../tests/Feature' => base_path('/tests/Feature')
        ], 'tests');

        // call code after boot application
        $this->app->booted(function () {

            // declare schedule
            $schedule = app(Schedule::class);

            // get daily reports
            $schedule->call(function () {
                CronService::checkReports(2);
            })->daily();

            // get weekly reports
            $schedule->call(function () {
                CronService::checkReports(3);
            })->weekly();

            // get monthly reports
            $schedule->call(function () {
                CronService::checkReports(4);
            })->monthly();

            // get quarterly reports
            $schedule->call(function () {
                CronService::checkReports(5);
            })->quarterly();

            // get yearly reports
            $schedule->call(function () {
                CronService::checkReports(6);
            })->yearly();

        });
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
        //
	}
}
