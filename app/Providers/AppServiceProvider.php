<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use App\Models\Warga;


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
        Paginator::useBootstrap();
        View::composer('*', function ($view) {
        $totalWarga = Warga::count();

        $wargaPerBlok = Warga::selectRaw("
    SUBSTRING_INDEX(alamat, '/', 1) as blok,
    COUNT(*) as total
")
->groupBy('blok')
->orderBy('blok')
->get();

        $view->with([
            'totalWarga' => $totalWarga,
            'wargaPerBlok' => $wargaPerBlok
        ]);
    });
    }
}
