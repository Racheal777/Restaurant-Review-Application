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
        // \Log::debug($this);
       
        return [
            'id' => $this->id,
            'name' => $this->name,
            'contact' => $this->contact,
            'website_url' => $this->website_url,
            'location' => $this->location,
            "average_ratings" => $this->average_ratings,
            'category' => $this->category,
            'working_hours' => $this->working_hours,
            'about' => $this->about,
            'profile image' => $this->profileimage,
            'imagesss' => $this->images,
            "reviews" => $this->reviews,
           
        ];
    }
}
