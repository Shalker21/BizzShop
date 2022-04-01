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
        View::composer('site.partials.nav_bottom', function ($view) {
            $view->with('nav_categories', 
                Category::where('parent_id', '623c46d9cd74b657a544ab00')
                            ->with(
                                'children',
                                'category_translation',
                                'childrens.category_translation', 
                                'childrens.childrens.category_translation', 
                                'childrens.childrens.childrens.category_translation', 
                                'category_image'
                                )
                            ->get()
        );
        });
    }
}
