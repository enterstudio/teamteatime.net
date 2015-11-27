<?php

namespace TTT\Providers;

use Illuminate\Support\ServiceProvider;
use League\CommonMark\Environment;
use Webuni\CommonMark\TableExtension\TableExtension;

class AppServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		//
	}

	/**
	 * Register any application services.
	 *
	 * This service provider is a great spot to register your various container
	 * bindings with the application. As you can see, we are registering our
	 * "Registrar" implementation here. You can add your own bindings too!
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind(
			'Illuminate\Contracts\Auth\Registrar',
			'TTT\Services\Registrar'
		);

        $this->app->resolving('markdown.environment', function (Environment $environment) {
            $environment->addExtension(new TableExtension());
        });
	}
}
