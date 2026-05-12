<?php

namespace App\Providers;

use App\Models\Cart;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Raise limits when PHP allows (often PERDIR only; max_file_uploads may still require php.ini / .user.ini).
        if (! app()->runningInConsole()) {
            @ini_set('upload_max_filesize', '128M');
            @ini_set('post_max_size', '512M');
            @ini_set('max_file_uploads', '200');
        }

        View::composer('layouts.web.header', function ($view) {
            $view->with('cartItemCount', Cart::itemCount());
        });
    }
}
