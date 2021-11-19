<?php

namespace App\Providers;

use App\Contracts\CategoryContract;
use App\Contracts\BrandContract;
use App\Contracts\ProductContract;
use App\Contracts\ProductVariantContract;
use App\Contracts\ProductOptionContract;
use Illuminate\Support\ServiceProvider;
use App\Repositories\CategoryRepository;
use App\Repositories\BrandRepository;
use App\Repositories\ProductRepository;
use App\Repositories\ProductVariantRepository;
use App\Repositories\ProductOptionRepository;


class RepositoryServiceProvider extends ServiceProvider
{
    protected $repositories = [
        CategoryContract::class         =>          CategoryRepository::class,
        BrandContract::class         =>             BrandRepository::class,
        ProductContract::class         =>             ProductRepository::class,
        ProductVariantContract::class         =>             ProductVariantRepository::class,
        ProductOptionContract::class         =>             ProductOptionRepository::class,
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
