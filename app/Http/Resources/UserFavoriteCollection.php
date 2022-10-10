<?php

namespace App\Http\Resources;

use App\Http\Resources\UserFavoriteResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UserFavoriteCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'data' => UserFavoriteResource::collection($this->collection)
        ];
    }
}
