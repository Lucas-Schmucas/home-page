<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'author' => $this->author,
            'image_url' => $this->image_url,
            'personal_summary' => $this->personal_summary,
            'url' => $this->url,
            'started_on' => $this->started_on,
            'finished_on' => $this->finished_on,
        ];
    }
}
