<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Jeep;
use App\Models\Role;
use App\Models\Trip;
use App\Models\User;
use Filament\Tables;
use App\Models\Fares;
use App\Models\Queue;
use App\Models\Places;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\DB;
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
                ->minDate(now()) // Set the minimum date
                ->format('m-d-Y')
                ->rules(['date', 'after_or_equal:now'])
                ->required('create')
                ->visibleOn('create', 'view')
                ->native(false),

            TimePicker::make('time')
                ->required('create')
                ->visibleOn('create', 'view')
                ->native(false),

            Select::make('fare')
                ->label('Fare')
                ->searchable()
                ->required('create')
                ->options(Fares::all()->pluck('fare', 'fare')),

            Select::make('driver')
                ->label('Driver')
                ->searchable()
                ->required('create')
                ->options(Queue::all()->pluck('driver', 'driver'))
                ->native(false)
                ->live()
                ->afterStateUpdated(function (Set $set, ?string $state) {
                    $jeep = Queue::where('driver', $state)->first();
                    if ($jeep) {
                        // Delete the data from the 'queue' table with the matching 'driver' value
                        Queue::where('driver', $state)->delete();

                        $set('jnumber', $jeep->jnumber);
                    }
                }),

            TextInput::make('jnumber')
                ->label('Plate Number')
                ->rules('required'),

            Select::make('status')
                ->options([
                    'completed' => 'Complete',
                    'on going' => 'on going',
                    'failed' => 'Failed',
                ])
                ->required('create')
                ->native(false),
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
                    ->label('Driving Time')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: false),
                TextColumn::make('driver')
                    ->label('Driver')
                    ->toggleable(),
                TextColumn::make('jnumber')
                    ->label('Plate Number')
                    ->toggleable(),
                TextColumn::make('fare')
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
