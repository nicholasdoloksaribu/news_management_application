<?php

namespace App\Filament\Resources\Histories\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class HistoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                TextInput::make('article_id')
                    ->required()
                    ->numeric(),
                TextInput::make('activities')
                    ->required(),
            ]);
    }
}
