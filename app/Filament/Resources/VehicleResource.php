<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VehicleResource\Pages;
use App\Filament\Resources\VehicleResource\RelationManagers;
use App\Models\Client;
use App\Models\Vehicle;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use function Laravel\Prompts\form;

class VehicleResource extends Resource
{
    protected static ?string $model = Vehicle::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $label = "Vehìculo";
    protected static ?string $pluralModelLabel = "Vehìculos";
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('brand')
                    ->label('Marca')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('model')
                    ->label('Modelo')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('plate')
                    ->label('Placa')
                    ->unique(ignoreRecord:true)
                    ->validationMessages([
                        'unique'=>'La placa ya pertenece a un vehiculo'
                    ])
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('manufacturing_year')
                    ->label('Año de fabricación')
                    ->required()
                    ->numeric() 
                ->rules([
                        'numeric',  // Valida que sea un número
                        'min:1900',  // Asegura que el año no sea menor a 1900
                        'max:' . now()->year,  // Asegura que el año no sea mayor al año actual
                    ])
                    ->validationMessages([
                        'max' => 'El año de fabricación no puede ser mayor al año actual.',
                        'min' => 'El año de fabricación no puede ser menor a 1900.',
                    ]),
                Forms\Components\Select::make('id_client')
                    ->label('Clientes')
                    ->placeholder('Seleccione un cliente')
                    ->searchPrompt('Buscar por DNI o nombre ...')
                    ->required()
                    ->relationship(name:'client', titleAttribute:'name', modifyQueryUsing:fn($query)=>$query->orderBy('name'),
                    )
                    ->getOptionLabelFromRecordUsing(function($record){
                        return "{$record->document_number} - {$record->full_name}";
                    })                   
                    ->searchable()
                    ->preload()
                    ->validationMessages([
                        'required'=>'Seleccione un cliente de la lista',
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('brand')
                    ->label('Marca')
                    ->searchable(),
                Tables\Columns\TextColumn::make('model')
                    ->label('Modelo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('plate')
                    ->label('Placa')
                    ->searchable(),
                Tables\Columns\TextColumn::make('manufacturing_year')
                    ->label('Año de fabricación'),
                Tables\Columns\TextColumn::make('client.full_name')
                    ->label('Propietario'),
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
            'index' => Pages\ListVehicles::route('/'),
            'create' => Pages\CreateVehicle::route('/create'),
            //'edit' => Pages\EditVehicle::route('/{record}/edit'),
        ];
    }
}
