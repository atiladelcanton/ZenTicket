<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;


class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        View::composer(['includes.sidebar'], function($view) {

            $menuService = app()->make('App\ProTicket\Services\ModuloService');

            $userId = auth()->user()->roles[0]->id;

            $modules = $menuService->renderList($userId);

            $view->with('modules', $modules);
        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
