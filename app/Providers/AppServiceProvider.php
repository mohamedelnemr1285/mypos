<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

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
        Schema::defaultStringLength(191);
        $path = 'public/dashboard';
        view()->share('css_path',$path.'/css');
        view()->share('js_path',$path.'/js');
        view()->share('img_path',$path.'/img');
        view()->share('plugin_path',$path.'/plugins');
        view()->share('bootstrap_path',$path.'/bootstrap');
        view()->share('img_path',$path.'/img');
    }
}
