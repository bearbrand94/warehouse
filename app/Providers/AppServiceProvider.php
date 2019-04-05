<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Itemlog;
use App\Observers\ItemlogObserver;
use App\Bongkar_footer;
use App\Muat_footer;
use App\Bongkar_header;
use App\Muat_header;
use App\Observers\BongkarObserver;
use App\Observers\MuatObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);
        Bongkar_footer::observe(BongkarObserver::class);
        Muat_footer::observe(MuatObserver::class);
        Itemlog::observe(ItemlogObserver::class);
        Bongkar_header::observe(BongkarHeaderObserver::class);
        Muat_header::observe(MuatHeaderObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

}
