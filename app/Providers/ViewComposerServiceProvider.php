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
        View::composer('site.partials.nav', function ($view) {
            $view->with('categories', 
                Category::where('parent_id', '6239bad3162dfd70f51fd870')
                            ->with(
                                'childrens',
                                'category_translation',
                                'childrens.category_translation', 
                                'childrens.childrens.category_translation', 
                                'childrens.childrens.childrens.category_translation', 
                                //'category_image'
                                )
                            ->get()
        );
        });
    }
}
