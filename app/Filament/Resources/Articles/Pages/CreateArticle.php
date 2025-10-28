<?php

namespace App\Filament\Resources\Articles\Pages;

use App\Filament\Resources\Articles\ArticleResource;
use Filament\Resources\Pages\CreateRecord;

class CreateArticle extends CreateRecord
{
    protected static string $resource = ArticleResource::class;

    public static function mutateDataBeforeCreate(array $data) : array 
    {
        $data['user_id'] = auth()->user()->id;
        return $data;
    }
}
