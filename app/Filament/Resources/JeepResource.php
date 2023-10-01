<?php

namespace App\Filament\Resources;

use Carbon\Carbon;
use Filament\Forms;
use App\Models\Jeep;
use App\Models\Role;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Illuminate\Support\Facades\Config;
use Filament\Forms\Components\Checkbox;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\JeepResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Filament\Resources\JeepResource\RelationManagers;

class JeepResource extends Resource
{
    protected static ?string $model = Jeep::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationGroup = 'Jeeps';

    public static function form(Form $form): Form
    {
        return $form
    ->schema([
        TextInput::make('jnumber')
            ->label('Plate Number')
            ->required(),

            Select::make('driver')
            ->label('Driver')
            ->options(
                // Fetch users with the "Driver" role and create options array
                User::join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                    ->where('model_has_roles.model_type', User::class)
                    ->where('model_has_roles.role_id', Role::where('name', 'Driver')->first()->id)
                    ->pluck('users.name', 'users.name')
                    ->toArray()
            )
            ->required(),
            
            Select::make('begin')
            ->label('Time In')
            ->options([
                Carbon::now('Asia/Manila')->format('H:i') => 'Time IN'
                // Add more options if needed
            ]),

        Select::make('end')
            ->label('Time Out')
            ->options([
                Carbon::now('Asia/Manila')->format('H:i') => 'Time Out'
                // Add more options if needed
            ]),

        // Other fields in your form...
    ]);
    

    
    }

   

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('jnumber'),
                TextColumn::make('driver'),
                TextColumn::make('begin'),
                TextColumn::make('end'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListJeeps::route('/'),
            'create' => Pages\CreateJeep::route('/create'),
            'edit' => Pages\EditJeep::route('/{record}/edit'),
        ];
    }    
}
