<?php

namespace App\Providers;

use App\Contracts\CategoryContract;
use App\Contracts\BrandContract;
use App\Contracts\ProductContract;
use Illuminate\Support\ServiceProvider;
use App\Repositories\CategoryRepository;
use App\Repositories\BrandRepository;
use App\Repositories\ProductRepository;


class RepositoryServiceProvider extends ServiceProvider
{
    protected $repositories = [
        CategoryContract::class         =>          CategoryRepository::class,
        BrandContract::class         =>             BrandRepository::class,
        ProductContract::class         =>             ProductRepository::class,
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->repositories as $interface => $implementation) {
            $this->app->bind($interface, $implementation);
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
}
