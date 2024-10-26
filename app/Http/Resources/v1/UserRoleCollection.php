<?php

namespace App\Http\Resources\v1;

use App\Http\Resources\v1\UserRoleResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UserRoleCollection extends ResourceCollection
{
    public $collects = UserRoleResource::class;
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'role' => $this->collection
        ];
    }
}
