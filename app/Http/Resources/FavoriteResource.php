<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FavoriteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        //$restaurant = new RestaurantResource($this->restaurant);
        return 
        [
            'id' => $this->id,
           // 'user' => $this->user,
            'restaurant'=> $this->restaurant
        ];
    }
}
