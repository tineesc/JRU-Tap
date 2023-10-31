<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Fares;
use App\Models\Places;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Request;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\FaresResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\FaresResource\RelationManagers;

class FaresResource extends Resource
{
    protected static ?string $model = Fares::class;

    protected static ?string $navigationIcon = 'heroicon-o-presentation-chart-bar';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationGroup = 'Metrics';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Select::make('location')
                ->label('Location')
                ->searchable()
                ->options(Places::all()->pluck('location', 'location'))
                ->required(),
            Select::make('destination')
                ->label('Destination')
                ->searchable()
                ->options(Places::all()->pluck('location', 'location'))
                ->required(),

            TextInput::make('fare')
                ->placeholder('Fare')
                ->numeric()
                ->required(),

            // TextInput::make('code')
            //     ->label('Code')
            //     ->rules('required')
            //     ->readOnly()
            //     ->disabledOn('edit'),

            // Select::make('status')
            //     ->options([
            //         'approve' => 'approve',
            //         'pending' => 'pending',
            //         'decline' => 'decline',
            //     ])
            //     ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('location'),
                TextColumn::make('destination'),
                TextColumn::make('fare'),
                TextColumn::make('code'),
                // TextColumn::make('status')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(), 
                Tables\Actions\DeleteAction::make()
                ])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make()])])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()]);
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
            'index' => Pages\ListFares::route('/'),
            'create' => Pages\CreateFares::route('/create'),
            'edit' => Pages\EditFares::route('/{record}/edit'),
        ];
    }
}
