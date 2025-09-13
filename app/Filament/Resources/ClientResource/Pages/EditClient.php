<?php

namespace App\Filament\Resources\ClientResource\Pages;

use App\Filament\Resources\ClientResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditClient extends EditRecord
{
    protected static string $resource = ClientResource::class;

   protected function getRedirectUrl(): string
   {
      return static::getResource()::getUrl('index');
   }
 
   protected function getHeaderActions(): array
   {
      return [
         Actions\DeleteAction::make()
            ->successNotification(
               Notification::make()
            ->title('Registo eliminado')
            ->body('')
            ->success()
         )

      ];
   }
   protected function getSavedNotification(): ?Notification
   {
      return null;
   }

   protected function afterSave()
   {
      Notification::make()
         ->title('Registro actualizado')
         ->body('')
         ->success()
         ->send();
   }
}