<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\TextInputColumn;
use App\Filament\Resources\UserResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\UserResource\RelationManagers;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationGroup = 'Settings';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('User')
                    ->description('User Page')
                    ->schema([
                        TextInput::make('name')
                            ->required(),
                        TextInput::make('email')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true),
                        TextInput::make('password')
                            ->password()
                            ->visibleOn(['create', 'edit'])
                            ,
                        Select::make('Roles')
                            ->multiple()
                            ->relationship(name: 'roles', titleAttribute: 'name')
                            ->searchable()
                            ->preload(),
                        Select::make('Permissions')
                            ->multiple()
                            ->relationship(name: 'permissions', titleAttribute: 'name')
                            ->searchable()
                            ->preload(),
                        TextInput::make('wallet_id')
                            ->visibleOn(['edit', 'view']),
                        TextInput::make('card_id')
                            ->visibleOn(['edit', 'view']),
                        TextInput::make('wallet_amount')
                            ->label('Wallet Balance')
                            ->ReadOnly(),
                        TextInput::make('card_amount')
                            ->label('Card Balance')
                            ->ReadOnly(),
                    ])->columns(2),
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
                    ->label('User ID'),
                TextColumn::make('name')
                    ->searchable()
                    ->label('Full Name')
                    ->toggleable(),
                TextColumn::make('email')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('wallet_id')
                    ->label('Wallet ID')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('wallet_amount')
                    ->label('Wallet Balance')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('card_id')
                    ->label('Card ID')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('card_amount')
                    ->label('Card Amount')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->searchable()
                    ->date('M Y')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->searchable()
                    ->label('Last update')
                    ->date('M Y : H m')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
