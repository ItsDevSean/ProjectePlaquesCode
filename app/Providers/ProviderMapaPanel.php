<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\SolarPanelsModel;
use App\Models\PanelType;
use Illuminate\Support\Facades\Auth;

class ProviderMapaPanel extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        View::composer(['tools.panels', 'mapaPrueva'], function ($view) {
            if (Auth::check()) {
                $panelType = PanelType::all();
                $panels = SolarPanelsModel::where('user_id', Auth::id())->get();
                $view->with(compact('panels', 'panelType'));
            }
        });
    }
}

