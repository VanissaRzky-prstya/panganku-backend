<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProdukResource\Pages;
use App\Filament\Resources\ProdukResource\RelationManagers;
use App\Models\Produk;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProdukResource extends Resource
{
    protected static ?string $model = Produk::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama_produk')
                ->label('Nama Produk')
                ->required(),

                TextInput::make('harga')
                ->label('Harga')
                ->numeric()
                ->prefix('Rp')
                ->required(),

                TextInput::make('stok')
                ->label('Stok')
                ->numeric()
                ->minValue(0)
                ->default(0),

                Select::make('kategori_id')
                ->label('Kategori')
                ->relationship('kategori', 'nama_kategori')
                ->required(),

                Textarea::make('deskripsi')
                ->label('Deskripsi')
                ->nullable(),

                FileUpload::make('foto')
                ->label('Foto Produk')
                ->disk('public')
                ->directory(fn($get)=>'produk/'. $get('kategori_id'))
                ->image()
                ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_produk')
                ->label('Nama')
                ->searchable(),

                TextColumn::make('harga')
                ->label('Harga')
                ->money('IDR'),

                TextColumn::make('stok')
                ->label('Stok'),

                TextColumn::make('kategori.nama_kategori')
                ->label('Kategori'),

                ImageColumn::make('foto')
                ->label('Foto Produk')
                ->disk('public')
                ->height(40)
                ->width(40)
                ->circular(),
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
            'index' => Pages\ListProduks::route('/'),
            'create' => Pages\CreateProduk::route('/create'),
            'edit' => Pages\EditProduk::route('/{record}/edit'),
        ];
    }
}
