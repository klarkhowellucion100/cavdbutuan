<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
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
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $userId = Auth::id();

                $pendingFarmMechanizationRequestsBoot = DB::table('farm_mechanizations')->where('request_status', 0)->count();

                $pendingCastrationAndSpayRequestsBoot = DB::table('castration_and_spays')->where('request_status', 0)->count();

                $view->with([
                    'pendingFarmMechanizationRequestsBoot' => $pendingFarmMechanizationRequestsBoot,
                    'pendingCastrationAndSpayRequestsBoot' => $pendingCastrationAndSpayRequestsBoot,
                ]);
            }
        });
        ini_set('max_execution_time', 600);
        Paginator::useBootstrapFour();
    }
}
