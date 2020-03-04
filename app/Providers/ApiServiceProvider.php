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
                    \App\Api\Repositories\Contracts\StuffRepositoryInterface::class,
                    \App\Api\Repositories\V1StuffRepository::class
                );
                $this->app->bind(
                    \App\Api\Repositories\Contracts\SessionRepositoryInterface::class,
                    \App\Api\Repositories\V1SessionRepository::class
                );

                $this->app->bind(
                    \App\Api\Services\Contracts\StuffServiceInterface::class,
                    \App\Api\Services\V1StuffService::class
                );
                $this->app->bind(
                    \App\Api\Services\Contracts\AuthServiceInterface::class,
                    \App\Api\Services\V1AuthService::class
                );
                $this->app->bind(
                    \App\Api\Services\Contracts\JwtServiceInterface::class,
                    \App\Api\Services\JwtService::class
                );

                $this->app->bind(
                    \App\Api\Dto\Contracts\DtoInterface::class,
                    \App\Api\Dto\StuffDTO::class
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
