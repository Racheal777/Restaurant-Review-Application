<?php

namespace App\Http\Resources;

use App\Http\Resources\ReviewCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        $review = new ReviewCollection($this->reviews);
        return 
        [
            'id' => $this->id,
            'name' => $this->name,
            'username' => $this->username,
            'reviews' => $review,
           // 'restaurant' => $this->reviews->restaurant
        ];
    }
}
