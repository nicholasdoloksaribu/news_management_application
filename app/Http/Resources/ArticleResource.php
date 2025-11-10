<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'article_id'=>$this->id,
            'title'=> $this->title,
            'content'=> $this->content,
            'image'=> $this->image,
            'writer'=> $this->whenLoaded('user') ? $this->user->name : null,
            'created'=> $this->created_at->format('d-m-y'),
            
            //komentar
            'komentar' => CommentResource::collection($this->whenLoaded('comments'))
        ];
    }
}
