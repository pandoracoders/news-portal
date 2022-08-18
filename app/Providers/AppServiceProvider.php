<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Backend\Category;
use App\Models\Backend\WebSetting;
use Illuminate\Support\Facades\Schema;

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
        if (Schema::hasTable("web_settings") && Schema::hasTable("categories")) {
            $settings = WebSetting::get()->groupBy("type");
            view()->share(["categories" => Category::all(), "web_settings" => $settings]);
        }
    }
}
