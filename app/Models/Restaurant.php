<?php

namespace App\Models;

use App\Models\Review;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Restaurant extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'about',
        'location',
        'images',
        'profileimage',

    ];

    protected $casts = [
        'images' => 'array'
    ];

    
//relationship
    public function reviews(){
        return $this->hasMany(Review::class);
    }


}
