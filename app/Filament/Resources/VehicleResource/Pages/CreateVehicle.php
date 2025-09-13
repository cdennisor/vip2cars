<?php

namespace App\Filament\Resources\VehicleResource\Pages;

use App\Filament\Resources\VehicleResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateVehicle extends CreateRecord
{
    protected static string $resource = VehicleResource::class;
       protected function getRedirectUrl(): string
   {
      return static::getResource()::getUrl('index');
   }

   protected function getCreatedNotification(): ?Notification
   {
      return null;
   }
}
