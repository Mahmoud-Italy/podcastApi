<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class S1Resource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'              => $this->id,
            'encrypt_id'      => encrypt($this->id),

            'title'           => explode(',', $this->title),
            'artist'          => explode(',', $this->artist),
            'year'            => explode(',', $this->year),
            'comments'        => explode(',', $this->comments),

            'dateForHumans'   => $this->created_at->diffForHumans(),
            'created_at'      => $this->created_at,
            'loading'         => false
        ];
    }
}
