<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EpisodeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        [
            'id' => $this->id,
            'title' => $this->title,
            'air_date' => $this->air_date,
            'characters' => $this->characters,
        ];
    }
}
