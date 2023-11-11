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
use Filament\Support\Colors\Color;
use Illuminate\Support\Facades\DB;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Fieldset;
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
            Section::make('Code for Trip')
                ->description('Select the according to Trip')
                ->schema([
                    Select::make('code')
                        ->label('Code')
                        ->searchable()
                        ->required('create')
                        ->options(Fares::all()->pluck('code', 'code'))
                        ->live()
                        ->afterStateUpdated(function (Set $set, ?string $state) {
                            $jeep = Fares::where('code', $state)->first();
                            if ($jeep) {
                                $set('location', $jeep->location);
                                $set('destination', $jeep->destination);
                                $set('fare', $jeep->fare);
                            }
                        })
                        ->disabledOn('edit'),
                ]),
            Fieldset::make('Trip information')
                ->schema([
                    TextInput::make('location')
                        ->label('Location')
                        ->rules('required')
                        ->readOnly()
                        ->disabledOn('edit'),

                    TextInput::make('destination')
                        ->label('Destination')
                        ->rules('required')
                        ->readOnly()
                        ->disabledOn('edit'),

                    TextInput::make('fare')
                        ->label('Fare')
                        ->rules('required')
                        ->readOnly()
                        ->disabledOn('edit'),
                ])
                ->columns(3),
            Fieldset::make('Schedule')
                ->schema([
                    Datepicker::make('date')
                        ->minDate(now()->format('Y-m-d')) // Set the minimum date in 'Y-m-d' format
                        ->format('Y-m-d')
                        ->rules(['date', 'after_or_equal:' . now()->format('Y-m-d')])
                        ->required('create')
                        ->visibleOn('create', 'view')
                        ->native(false)
                        ->disabledOn('edit'),

                    TimePicker::make('time')
                        ->required('create')
                        ->visibleOn(['create', 'view','edit'])
                        // ->native(false)
                        ->withoutSeconds()
                        ->displayFormat('H:i A')
                        ,
                ])
                ->columns(2),

          

            Fieldset::make('Label')
                ->schema([

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
                            // Update the 'queue' column in the 'Jeep' table to null
                            Jeep::where('driver', $state)->update(['queue' => null]);
                            // Delete the data from the 'queue' table with the matching 'driver' value
                            Queue::where('driver', $state)->delete();
    
                            $set('jnumber', $jeep->jnumber);
                        }
                    })
                    ->disabledOn('edit'),
                    TextInput::make('jnumber')
                        ->label('Plate Number')
                        ->rules('required')
                        ->readOnly()
                        ->disabledOn('edit'),

                    Radio::make('trips')
                        ->label('Trip Jeep Status')
                        ->options([
                            'oneway' => 'One way',
                            'roundtrip' => 'Round Trip',
                        ])
                        ->required()
                        ->disabledOn('edit'),

                    Select::make('status')
                        ->options([
                            'completed' => 'Complete',
                            'on going' => 'on going',
                            'failed' => 'Failed',
                        ])
                        ->default('on goind')
                        ->required('create')
                        ->native(false)
                        ->visibleOn('edit'),
                ])
                ->columns(3),
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
                    ->label('Time')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: false),
                TextColumn::make('driver')
                    ->label('Driver')
                    ->toggleable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('jnumber')
                    ->label('Jeep')
                    ->toggleable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('fare')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('trips')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('status')
                    ->sortable()
                    ->searchable()
                    ->badge()
                    ->toggleable(isToggledHiddenByDefault: true),
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
