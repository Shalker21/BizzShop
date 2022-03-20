<?php

namespace App\Providers;

use App\Contracts\CategoryContract;
use App\Contracts\BrandContract;
use App\Contracts\ProductContract;
use App\Contracts\ProductImageContract;
use App\Contracts\ProductVariantContract;
use App\Contracts\ProductOptionContract;
use App\Contracts\ProductOptionValueContract;
use App\Contracts\ProductAttributeContract;
use App\Contracts\ProductAttributeValueContract;
use App\Contracts\InventoryContract;
use App\Contracts\InventorySourceStockContract;
use Illuminate\Support\ServiceProvider;
use App\Repositories\CategoryRepository;
use App\Repositories\BrandRepository;
use App\Repositories\ProductRepository;
use App\Repositories\ProductImageRepository;
use App\Repositories\ProductVariantRepository;
use App\Repositories\ProductOptionRepository;
use App\Repositories\ProductOptionValueRepository;
use App\Repositories\ProductAttributeRepository;
use App\Repositories\ProductAttributeValueRepository;
use App\Repositories\InventoryRepository;
use App\Repositories\InventorySourceStockRepository;


class RepositoryServiceProvider extends ServiceProvider
{
    protected $repositories = [
        CategoryContract::class         =>          CategoryRepository::class,
        BrandContract::class         =>             BrandRepository::class,
        ProductContract::class         =>             ProductRepository::class,
        ProductImageContract::class         =>             ProductImageRepository::class,
        ProductVariantContract::class         =>             ProductVariantRepository::class,
        ProductOptionContract::class         =>             ProductOptionRepository::class,
        ProductOptionValueContract::class         =>             ProductOptionValueRepository::class,
        ProductAttributeContract::class         =>             ProductAttributeRepository::class,
        ProductAttributeValueContract::class         =>             ProductAttributeValueRepository::class,
        InventoryContract::class                    =>              InventoryRepository::class,
        InventorySourceStockRepository::class                    =>              InventorySourceStockRepository::class,
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
