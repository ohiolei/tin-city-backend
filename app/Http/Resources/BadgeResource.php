<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BadgeResource extends JsonResource
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
            'name' => $this->name,
            'description' => $this->description,
            'points_required' => $this->points_required,
            'icon' => $this->icon,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'user_badges' => $this->whenLoaded('userBadges', function () {
                return UserBadgeResource::collection($this->userBadges);
            }),
        ];
    }
}
