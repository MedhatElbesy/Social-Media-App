<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TweetResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            __('response.id')      => $this->id,
            __('response.user_id') => $this->user_id,
            __('response.tweet')   => $this->tweet,
        ];
    }
}
