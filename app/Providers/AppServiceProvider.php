<?php

namespace App\Providers;

use App\Connection\RandomUserConnection;
use App\Connection\RandomUserHttpClient;
use App\Connection\UserConnection;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            UserConnection::class,
            function () {
                $configuration = config('importable.users');
                return new RandomUserConnection(
                    new RandomUserHttpClient([
                        'base_uri' => data_get($configuration, 'base_uri'),
                        'timeout' => data_get($configuration, 'timeout'),
                    ])
                );
            }
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
