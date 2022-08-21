<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(['site.partials.nav_bottom'], function ($view) {
            $view->with('nav_categories', 
                Category::where('parent_id', '62bc8dbfece74b5a366c6162')
                            ->with(
                                'children',
                                'category_translation',
                                'children.category_translation', 
                                'children.children.category_translation',
                                'category_image'
                                )
                            ->get()
        );
        });
    }
}
