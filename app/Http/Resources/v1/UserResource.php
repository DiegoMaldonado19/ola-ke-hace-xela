<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'username' => $this->username,
            'role' => new UserRoleResource($this->role),
            'email' => $this->email,
            'cui' => $this->cui,
            'name' => $this->name,
            'lastname' => $this->lastname,
            'phone' => $this->phone,
            'automatically_post' => $this->automatically_post
        ];
    }
}
