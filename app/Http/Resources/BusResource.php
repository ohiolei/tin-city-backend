<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BusResource extends JsonResource
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
            'route_id' => $this->route_id,
            'name' => $this->name,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'route' => $this->whenLoaded('route', function () {
                return new RouteResource($this->route);
            }),
            'chats' => $this->whenLoaded('chats', function () {
                return ChatResource::collection($this->chats);
            }),
        ];
    }
}
