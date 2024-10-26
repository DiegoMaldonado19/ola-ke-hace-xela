<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'place' => $this->place,
            'description' => $this->description,
            'user' => new UserResource($this->user),
            'start_date_time' => $this->start_date_time,
            'end_date_time' => $this->end_date_time,
            'capacity_limit' => $this->capacity_limit,
            'category' => new PostCategoryResource($this->category),
            'post_strike_count' => $this->post_strike_count,
            'approved' => $this->approved
        ];
    }
}
