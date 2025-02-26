<?php

namespace Modules\ServiceModule\Filament\Resources\ServiceResource\Pages;

use Modules\ServiceModule\Filament\Resources\ServiceResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateService extends CreateRecord
{
    protected static string $resource = ServiceResource::class;
}
