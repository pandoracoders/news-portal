<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Backend\Category;
use App\Models\Backend\WebSetting;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        $settings = WebSetting::get()->groupBy("type");
        view()->share(["categories" => Category::all(), "web_settings" => $settings]);
    }
}
