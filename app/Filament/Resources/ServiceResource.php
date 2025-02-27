<?php

namespace Modules\Service\Filament\Resources;

use App\Filament\Helpers\FilamentHelpers;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Modules\CategoryModule\Models\Category;
use Modules\Service\Filament\Resources\ServiceResource\Pages;
use Modules\Service\Filament\Resources\ServiceResource\RelationManagers;
use Modules\Service\Models\Service;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Nwidart\Modules\Facades\Module;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static ?string $navigationIcon = 'heroicon-o-cpu-chip';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                SpatieMediaLibraryFileUpload::make('image')
                    ->translateLabel()
                    ->collection(fn() => (new self::$model)->getPrimaryMediaCollection())
                    ->avatar()
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/jpg', 'image/webp'])
                    ->openable()
                    ->downloadable()
                    ->alignCenter()
                    ->columnSpanFull()
                    ->required(),

                FilamentHelpers::translateFilamentField(
                    Forms\Components\TextInput::make('name')
                        ->label(__('Name')),
                    ['*']
                ),
                FilamentHelpers::translateFilamentField(
                    Forms\Components\TextInput::make('description')
                        ->label(__('Description')),
                    ['*']
                ),
                Forms\Components\Select::make('category_id')->translateLabel()
                    ->relationship('category', 'name')
                    ->visible(Module::has('CategoryModule') && Module::find('CategoryModule')->isEnabled())
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('image')
                    ->translateLabel()
                    ->limit(1)
                    ->circular()
                    ->collection(fn() => (new self::$model)->getPrimaryMediaCollection())
                    ->toggleable(),
                Tables\Columns\TextColumn::make('name')
                    ->translateLabel()
                    ->searchable()->forceSearchCaseInsensitive()
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('description')
                    ->translateLabel()
                    ->searchable()->forceSearchCaseInsensitive()
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->visible(Module::has('CategoryModule') && Module::find('CategoryModule')->isEnabled())
                    ->translateLabel()
                    ->searchable()->forceSearchCaseInsensitive()
                    ->sortable()
                    ->toggleable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }
}
