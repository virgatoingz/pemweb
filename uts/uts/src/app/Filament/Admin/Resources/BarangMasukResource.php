<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\BarangMasukResource\Pages;
use App\Filament\Admin\Resources\BarangMasukResource\RelationManagers;
use App\Models\BarangMasuk;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BarangMasukResource extends Resource
{
    protected static ?string $model = BarangMasuk::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('id_barang')
                    ->required()
                    ->numeric(),
                Forms\Components\DatePicker::make('tanggal_masuk')
                    ->required(),
                Forms\Components\TextInput::make('jumlah')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id_barang')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tanggal_masuk')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('jumlah')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListBarangMasuks::route('/'),
            'create' => Pages\CreateBarangMasuk::route('/create'),
            'edit' => Pages\EditBarangMasuk::route('/{record}/edit'),
        ];
    }
}
