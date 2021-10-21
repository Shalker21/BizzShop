<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Models\Setting;

class SettingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('settings', function ($app) {
            return new Setting();
        });
        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('Setting', Setting::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // so we can use setting config on all app
        if (!\App::runningInConsole() /*&& count(Schema::getColumnListing('settings'))*/) {
            $settings = Setting::all();
            foreach ($settings as $key => $setting) {
                Config::set('settings.'.$setting->key, $setting->value);
            }
        }
    }
}
