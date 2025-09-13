<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClientResource\Pages;
use App\Filament\Resources\ClientResource\RelationManagers;
use App\Models\Client;
use Closure;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ClientResource extends Resource
{
    protected static ?string $model = Client::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    
    protected static ?string $label = "Cliente";
    protected static ?string $pluralModelLabel = "Clientes";
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nombres')
                    ->maxLength(255)
                    ->default(null)
                    ->regex('/^[\p{L}\s]+$/u')
                    ->afterStateUpdated(function ($state, callable $set) {
                        $set('name', trim($state));
                    })
                    ->validationMessages([
                        'regex' => 'Ingrese solo texto',
                    ]),
                Forms\Components\TextInput::make('last_name')
                    ->label('Apellidos')
                    ->maxLength(255)
                    ->default(null)
                    ->regex('/^[\p{L}\s]+$/u')
                    ->afterStateUpdated(function ($state, callable $set) {
                        $set('last_name', trim($state));
                    })
                    ->validationMessages([
                        'regex' => 'Ingrese solo texto',
                    ]),
                Forms\Components\TextInput::make('document_number')
                    ->label('N° documento')
                    ->required()
                    ->validationAttribute('DNI')
                    ->unique(ignoreRecord:true)
                    ->numeric()
                    ->rules([
                        'min:10000000',
                        'max:99999999',
                        'regex:/^[1-9][0-9]{7}$/',
                    ])
                    ->afterStateUpdated(function ($state, callable $set) {
                        $set('document_number', trim($state));
                    })
                    ->validationMessages([
                        'required' => 'El :attribute  es obligatorio.',
                        'unique' => 'El :attribute ya existe',
                        'numeric' => 'El :attribute debe ser un número.',
                        'min' => 'Ingrese un DNI válido de 8 digitos',
                        'max' => 'Ingrese un DNI válido de 8 digitos',
                        'rules' => 'Ingrese un DNI válido de 8 digitos',
                    ])
                    ->rules([
                        fn (Get $get): Closure => function (string $attribute, $value, Closure $fail) use ($get) {
                            // Obtenemos el valor del cliente (id_client)
                            $clientId = $get('document_number');
                            
                            // Verificamos si ya existe un cliente con el mismo DNI
                            $exists = Client::where('document_number', $clientId)
                            ->where('document_number', '!=', $get('document_number')) // Ignora el cliente actual si estamos editando
                            ->exists();

                            // Si ya existe, fallamos la validación
                            if ($exists) {
                            $fail("El DNI '".$value."' ya está en uso.");
                            //$fail("El DNI '".strtoupper($value)."' ya está en uso.");
                            }
                        }
                    ])->afterStateUpdated(fn ($state, callable $set) => $set('DNI', trim($state))),
                Forms\Components\TextInput::make('email')
                    ->label('Correo electrónico')
                     ->unique(ignoreRecord:true)
                     ->email()
                     ->afterStateUpdated(function ($state, callable $set) {
                        $set('email', trim($state));
                     })
                     ->validationMessages([
                        'unique' => 'El correo electrónico ya existe',
                        'email' => 'Ingrese un correo válido',
                     ]),
                Forms\Components\TextInput::make('phone')
                    ->label('#Celular')
                    
                    ->afterStateUpdated(function ($state, callable $set) {
                        $set('phone', trim($state));
                    })
                    ->default(null)
                    ->tel()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('document_number')
                    ->label('N°. Documento')
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable(),
                Tables\Columns\TextColumn::make('last_name')
                    ->label('Apellidos')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Correo electrónico'),
                Tables\Columns\TextColumn::make('phone')
                    ->label('Celular'),
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
            'index' => Pages\ListClients::route('/'),
            'create' => Pages\CreateClient::route('/create'),
            //'edit' => Pages\EditClient::route('/{record}/edit'),
        ];
    }
}
