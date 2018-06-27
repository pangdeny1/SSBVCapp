<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Crops extends JsonResource
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
            "id" => $this->id,
            "name" => $this->name,
            "description" => str_limit($this->description, 60),
            "placeholder" => $this->placeholder,
            "color" => "bg-{$this->color}",
        ];
    }
}
