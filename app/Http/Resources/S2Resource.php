<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class S2Resource extends JsonResource
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
            'id'               => $this->id,
            'encrypt_id'       => encrypt($this->id),

            'language'         => $this->language_json,
            'encoding_tool'    => $this->encoding_tool,

            'dateForHumans'    => $this->created_at->diffForHumans(),
            'created_at'       => $this->created_at,
            'loading'          => false
        ];
    }
}
