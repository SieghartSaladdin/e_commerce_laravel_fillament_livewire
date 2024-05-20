<?php

namespace App\Filament\Resources\OrderResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class AddressRelationManager extends RelationManager
{
    protected static string $relationship = 'address';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('first_name')
                ->required()
                ->maxlength(255),

                TextInput::make('last_name')
                ->required()
                ->maxlength(255),

                TextInput::make('phone')
                ->required()
                ->tel()
                ->maxlength(20),

                TextInput::make('city')
                ->required()
                ->maxlength(255),

                TextInput::make('state')
                ->required()
                ->maxlength(255),

                TextInput::make('zip_code')
                ->required()
                ->maxlength(10),

                Textarea::make('street_address')
                ->required()
                ->columnSpanFull()
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('street_address')
            ->columns([
                TextColumn::make('fullname')
                ->label('Full Name'),

                TextColumn::make('phone'),

                TextColumn::make('city'),

                TextColumn::make('state'),

                TextColumn::make('zip_code'),

                TextColumn::make('street_address')
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
