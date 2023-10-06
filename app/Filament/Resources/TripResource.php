<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Jeep;
use App\Models\Role;
use App\Models\Trip;
use App\Models\User;
use Filament\Tables;
use App\Models\Fares;
use App\Models\Places;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TimePicker;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\TripResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\TripResource\RelationManagers;

class TripResource extends Resource
{
    protected static ?string $model = Trip::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-euro';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationGroup = 'Travel';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Select::make('location')
                ->label('Location')
                ->searchable()
                ->options(Fares::all()->pluck('location', 'location'))
                ->required(),
            Select::make('destination')
                ->label('Destination')
                ->searchable()
                ->options(Fares::all()->pluck('destination', 'destination'))
                ->required(),

            Datepicker::make('Select Date')
                ->native(false)
                ->minDate(now()) // Set the minimum date
                ->format('m-d-Y')
                ->rules(['date', 'after_or_equal:now'])
                ->required('create')
                ->visibleOn('create', 'view'),

            TimePicker::make('time')
                ->native(false)
                ->required('create')
                ->visibleOn('create', 'view'),

            Select::make('fare')
                ->label('Fare')
                ->searchable()
                ->required('create')
                ->options(Fares::all()->pluck('fare', 'fare')),

            Select::make('driver')
                ->label('Driver')
                ->options(
                    // Fetch users with the "Driver" role and create options array
                    User::join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                        ->where('model_has_roles.model_type', User::class)
                        ->where('model_has_roles.role_id', Role::where('name', 'Driver')->first()->id)
                        ->pluck('users.name', 'users.name')
                        ->toArray(),
                )->required('create'),

            TextInput::make('jnumber')
            ->label('Plate Number')
            ->required('create'),
            Select::make('status')
                ->options([
                    'completed' => 'Complete',
                    'pending' => 'Pending',
                    'failed' => 'Failed',
                ])->required('create'),
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
            ->actions([Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make()])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])])
            ->emptyStateActions([Tables\Actions\CreateAction::make()]);
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
            'index' => Pages\ListTrips::route('/'),
            'create' => Pages\CreateTrip::route('/create'),
            'edit' => Pages\EditTrip::route('/{record}/edit'),
        ];
    }
}
