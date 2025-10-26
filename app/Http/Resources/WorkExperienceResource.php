<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkExperienceResource extends JsonResource
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
            'job_title' => $this->job_title,
            'description' => $this->description,
            'image_url' => $this->image_url,
            'company_name' => $this->company_name,
            'color' => $this->color,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'technologies' => $this->technologies,
        ];
    }
}
