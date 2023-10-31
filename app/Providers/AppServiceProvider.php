<?php

namespace App\Providers;

use App\Http\viewComposers\HeaderComposer;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        view()->composer(
        [
            'components.navbar_component',
            'components.aside_component',
            'components.footer_component'
        ], HeaderComposer::class);
    }
}
