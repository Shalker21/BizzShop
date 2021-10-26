<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiseProvider extends ServiceProvider
{
    protected $repositories = [
        CategoryContract::class     =>      CategoryRepository::class,
    ];
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->repositories as $interface => $repository) {
            $this->app->bind($interface, $repository);
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
