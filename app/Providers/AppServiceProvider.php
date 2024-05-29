<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            \App\Interfaces\BranchRepositoryInterface::class,
            \App\Repositories\BranchRepository::class
        );

        $this->app->bind(
            \App\Interfaces\BookingRepositoryInterface::class,
            \App\Repositories\BookingRepository::class
        );

        $this->app->bind(
            \App\Interfaces\VehicleRepositoryInterface::class,
            \App\Repositories\VehicleRepository::class
        );

        $this->app->bind(
            \App\Interfaces\BookingHistoryRepositoryInterface::class,
            \App\Repositories\BookingHistoryRepository::class
        );

        $this->app->bind(
            \App\Interfaces\BranchManagerRepositoryInterface::class,
            \App\Repositories\BranchManagerRepository::class
        );

        $this->app->bind(
            \App\Interfaces\HeadOfficeManagerRepositoryInterface::class,
            \App\Repositories\HeadOfficeManagerRepository::class
        );

        $this->app->bind(
            \App\Interfaces\CompanyDriverRepositoryInterface::class,
            \App\Repositories\CompanyDriverRepository::class
        );

        $this->app->bind(
            \App\Interfaces\CompanyDriverRepositoryInterface::class,
            \App\Repositories\CompanyDriverRepository::class
        );

        $this->app->bind(
            \App\Interfaces\AuthRepositoryInterface::class,
            \App\Repositories\AuthRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
