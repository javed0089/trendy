<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class SidebarComposerProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
          view()->composer(
            ['backend.partials._adminsidebar','layouts.main'],'App\Http\ViewComposers\SidebarComposer');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->composeSidebar();
    }

    public function composeSidebar(){

    }
}
