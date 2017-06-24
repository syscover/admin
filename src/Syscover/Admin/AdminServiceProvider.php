<?php namespace Syscover\Admin;

use Illuminate\Support\ServiceProvider;
use Syscover\Admin\GraphQL\AdminGraphQLServiceProvider;


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

        // register migrations
        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');

        // register seeds
        $this->publishes([
            __DIR__ . '/../../database/seeds/' => base_path('/database/seeds')
        ], 'seeds');

        // register tests
        $this->publishes([
            __DIR__ . '/../../tests/Feature/' => base_path('/tests/Feature')
        ], 'tests');

        // register config files
        $this->publishes([
            __DIR__ . '/../../config/pulsar.admin.php' => config_path('pulsar.admin.php'),
        ]);

        // register GraphQL types and schema
        AdminGraphQLServiceProvider::bootGraphQLTypes();
        AdminGraphQLServiceProvider::bootGraphQLSchema();
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{

	}
}