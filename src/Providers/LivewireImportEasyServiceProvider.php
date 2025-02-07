<?php

namespace Gsferro\LivewireImportEasy\Providers;

use Gsferro\ResourceCrudEasy\Commands\{ResourceCrudEasyModelCommand, ResourceCrudEasyChoiceTableCommand};
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Filesystem\Filesystem;

class LivewireImportEasyServiceProvider extends ServiceProvider
{
    public function boot()
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
        $path = 'components.vendor.livewire-import-easy';
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
            __DIR__ . '/../views/components' => resource_path('views/components/vendor/livewire-import-easy'),
        ], 'views');
    }
}
