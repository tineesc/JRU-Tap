<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Triplog;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\TriplogResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\TriplogResource\RelationManagers;

class TriplogResource extends Resource
{
    protected static ?string $model = Triplog::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationGroup = 'Trip Monitoring';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                ->sortable()
                ->searchable()
                ->toggleable(isToggledHiddenByDefault: true)
                ->label('Trip ID'),
            TextColumn::make('location')
                ->sortable()
                ->searchable()
                ->toggleable(isToggledHiddenByDefault: false),
            TextColumn::make('destination')
                ->sortable()
                ->searchable()
                ->toggleable(isToggledHiddenByDefault: false),
            TextColumn::make('date')
                ->sortable()
                ->searchable()
                ->toggleable(isToggledHiddenByDefault: false),
            TextColumn::make('time')
                ->sortable()
                ->searchable()
                ->toggleable(isToggledHiddenByDefault: false),
            TextColumn::make('driver')
                ->label('Driver')
                ->toggleable(),
                TextColumn::make('fare')
                ->sortable()
                ->searchable()
                ->toggleable(isToggledHiddenByDefault: false),
                TextColumn::make('departure')
                ->sortable()
                ->searchable()
                ->toggleable(isToggledHiddenByDefault: false),
            TextColumn::make('status')
                ->sortable()
                ->searchable()
                ->badge()
                ->toggleable(isToggledHiddenByDefault: false),
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
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
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
            'index' => Pages\ListTriplogs::route('/'),
            'create' => Pages\CreateTriplog::route('/create'),
            'edit' => Pages\EditTriplog::route('/{record}/edit'),
        ];
    }    
}
