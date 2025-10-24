<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HistoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
          'history_id' => $this->id,
          'user_id' => $this->user_id,
          'activities' => $this->activities,
          'created_at' => $this->created_at->format('d-m-y')
        ];
    }
}
