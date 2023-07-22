<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class ListUsers extends ListRecords
{    
    protected static string $resource = UserResource::class;
 
    // protected function getHeaderActions(): array
    // {
    //     return [
    //         Actions\CreateAction::make(),
    //     ];
    // }
}
