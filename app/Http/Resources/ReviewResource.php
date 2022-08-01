<?php

namespace App\Http\Resources;

use App\Models\Restaurant;
use App\Http\Resources\UserResource;
use App\Http\Resources\RestaurantResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        //$creator = new UserResource($this->user);
         //$restaurant = new RestaurantResource($this->restaurant);
        return 
        [
            'id' => $this->id,
            'comment' => $this->comment,
            'ratings' => $this->ratings,
            'user' => $this->user,
             'restaurant' => $this->restaurant
        ];
    }
}
