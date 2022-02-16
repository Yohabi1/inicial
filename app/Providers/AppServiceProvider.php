<?php

namespace App\Providers;

use App\General;
use App\Menu;
use App\Social;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use Pranto\MultiLanguage\Models\Language;

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
        view()->share('general', General::first());
        view()->share('social', Social::get());
        view()->share('frontMenu', Menu::get());
        view()->share('lang', Language::get());

        // if(General::first()->template_sel == 0 ){

           
        //     $this->loadViewsFrom(resource_path('views1'),'views1');
        // }else{
        //      $this->loadViewsFrom(resource_path('views'),'views');
        // } 
    }
}
