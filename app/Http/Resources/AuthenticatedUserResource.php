<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AuthenticatedUserResource extends JsonResource
{
    public static $wrap = null;

    public function toArray($request): array
    {
        $user = $this->resource;
        $role = $user->role;
        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'role' => $role?->name,
            'permissions' => $role?->permissions?->pluck('name')
        ];
    }
}
