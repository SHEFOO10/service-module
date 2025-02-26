<?php

namespace Modules\ServiceModule\Filament;

use Coolsam\Modules\Concerns\ModuleFilamentPlugin;
use Filament\Contracts\Plugin;
use Filament\Panel;

class ServiceModulePlugin implements Plugin
{
    use ModuleFilamentPlugin;

    public function getModuleName(): string
    {
        return 'ServiceModule';
    }

    public function getId(): string
    {
        return 'servicemodule';
    }

    public function boot(Panel $panel): void
    {
        // TODO: Implement boot() method.
    }
}
