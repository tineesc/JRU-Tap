<?php

namespace App\Filament\Resources;

use Carbon\Carbon;
use Filament\Forms;
use App\Models\Role;
use App\Models\User;
use Filament\Tables;
use App\Models\Queue;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use App\Filament\Resources\QueueResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\QueueResource\Pages\EditQueue;
use App\Filament\Resources\QueueResource\Pages\ListQueues;
use App\Filament\Resources\QueueResource\RelationManagers;
use App\Filament\Resources\QueueResource\Pages\CreateQueue;

class QueueResource extends Resource
{
    protected static ?string $model = Queue::class;

    protected static ?string $navigationIcon = 'heroicon-o-queue-list';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationGroup = 'Jeeps';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('jnumber')
                ->label('Plate Number')
                ->required()
                ->visibleOn(['view', 'edit'])
                ->disabledOn(['edit']),

            Select::make('driver')
                ->label('Driver')
                ->options(
                    // Fetch users with the "Driver" role and create options array
                    User::join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                        ->where('model_has_roles.model_type', User::class)
                        ->where('model_has_roles.role_id', Role::where('name', 'Driver')->first()->id)
                        ->pluck('users.name', 'users.name')
                        ->toArray(),
                )
                ->visibleOn(['view', 'edit'])
                ->disabledOn(['edit']),
            Select::make('status')
                ->options([
                    'in queue' => 'in queue',
                    'next' => 'next',
                    'pending' => 'pending',
                ])
                ->required()
                ->visibleOn(['view', 'edit']),
            //     Select::make('begin')
            //     ->label('Jeep Queue')
            //     ->options([
            //         Carbon::now('Asia/Manila')->format('H:i') => 'Add to Jeep Queue Table'
            //         // Add more options if needed
            //     ])->visibleOn(['view']),

            // Select::make('end')
            //     ->label('Driver Notify')
            //     ->options([
            //         Carbon::now('Asia/Manila')->format('H:i') => 'Driver Notify to Add Jeep Queue'
            //         // Add more options if needed
            //     ])->visibleOn(['view']),

            // Other fields in your form...
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([TextColumn::make('driver')->label('Driver'), 
            TextColumn::make('jnumber')->label('Plate Number'), 
            TextColumn::make('begin')->label('Arrival Time'), 
            TextColumn::make('end')->label('Driver Request in Queue'), 
            TextColumn::make('status')->label('Status')])
            ->filters([
                //
            ])
            ->actions([Tables\Actions\ViewAction::make(), Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make()])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])])
            ->emptyStateActions([
                // Tables\Actions\CreateAction::make(),
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
            'index' => Pages\ListQueues::route('/'),
            'create' => Pages\CreateQueue::route('/create'),
            'edit' => Pages\EditQueue::route('/{record}/edit'),
        ];
    }
}
