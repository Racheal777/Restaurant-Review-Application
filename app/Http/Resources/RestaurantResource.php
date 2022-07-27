<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RestaurantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $images = $this->images;

       
        return [
            'id' => $this->id,
            'name' => $this->name,
            'location' => $this->location,
            'about' => $this->about,
            'profile image' => $this->profileimage,
           // 'images' => json_decode($this->images),
            'imagesss' => $this->images,
            'images type' => gettype($this->images) 
        ];
    }
}
