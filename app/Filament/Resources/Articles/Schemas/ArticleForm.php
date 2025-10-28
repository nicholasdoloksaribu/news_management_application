<?php

namespace App\Filament\Resources\Articles\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;

class ArticleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                //
                TextInput::make('title')->required(),
                Textarea::make('content')->required(),
                FileUpload::make('image')
                ->label('Image')
                ->image()
                ->directory('article')
                ->disk('public')
                ->maxSize(2048)
                ->imagePreviewHeight('150')
            ]);
    }
}
