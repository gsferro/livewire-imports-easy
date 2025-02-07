<?php

namespace Gsferro\LivewireImportEasy\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class LivewireImportEasyServiceProvider extends ServiceProvider
{
    private string $pathPackage = 'livewire-import-easy';

    public function boot(): void
    {
        $this->publisher();
        $this->blades();
    }

    private function blades(): void
    {
        /*
        |---------------------------------------------------
        | Alias blade
        |---------------------------------------------------
        |
        | Components
        |
        */
        $path = 'components.'. $this->pathPackage;
        Blade::component($path.'.import-easy', 'livewire-import-easy');
        Blade::component($path.'.import-finished', 'livewire-import-easy-finished');
        Blade::component($path.'.update-import-progress', 'livewire-update-import-easy-progress');
    }

    private function publisher(): void
    {
        /*
        |---------------------------------------------------
        | Views
        |---------------------------------------------------
        */
        $this->publishes([
            __DIR__ . '/../views/components' => resource_path('views/components/' . $this->pathPackage),
        ], 'views');
    }
}
