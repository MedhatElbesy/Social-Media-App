<?php

namespace App\Http\Resources;

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
            __('response.id')        => $this->id,
            __('response.username')  => $this->username,
            __('response.email')     => $this->email,
            __('response.image')     => $this->image,
            __('response.token')     => $this->when(isset($this->token), $this->token),

        ];
    }
}
