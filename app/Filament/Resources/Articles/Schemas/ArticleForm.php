<?php

namespace App\Filament\Resources\Articles\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Illuminate\Support\Facades\Storage;

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
                ->disk('local')
                ->maxSize(2048)
                ->imagePreviewHeight('150')
                ->getUploadedFileNameForStorageUsing(function ($file){
                    $extension = $file->getClientOriginalExtension();
                    $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                    return $originalName.'-'.rand(1,200).'.'.$extension;
                })
                ->deleteUploadedFileUsing(fn ($file) => Storage::disk('public')->delete($file))
            ]);
    }
}
