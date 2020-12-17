<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BlogEntryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //returns mapped array
        return [
            'id' => $this->id,
            'user_id' => $this->user->id,
            'username' => $this->user->name,
            'headline' => $this->headline,
            'content' => $this->content,
        ];
    }
}
