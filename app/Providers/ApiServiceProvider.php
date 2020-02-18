<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ApiServiceProvider extends ServiceProvider
{
    const VERSION_API_V1 = 'v1';

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        switch ($this->getVersionApi()) {
            case self::VERSION_API_V1:
                $this->app->bind(
                    \App\Api\Repositories\StuffRepositoryInterface::class,
                    \App\Api\Repositories\V1StuffRepository::class
                );
                $this->app->bind(
                    \App\Api\Services\StuffServiceInterface::class,
                    \App\Api\Services\V1StuffService::class
                );
                $this->app->bind(
                    \App\Api\Models\StuffInterface::class,
                    \App\Api\Models\V1Stuff::class
                );
                $this->app->bind(
                    \App\Api\Services\Contracts\AuthServiceInterface::class,
                    \App\Api\Services\V1AuthService::class
                );
        }
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

    /**
     * @return string
     */
    private function getVersionApi(): string
    {
        $contentType = request()->headers->get('content-type');
        $apiData = explode('+', last(explode('/', $contentType)));

        return array_shift($apiData);
    }
}
