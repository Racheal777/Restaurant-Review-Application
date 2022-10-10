<?php

namespace Tests\Feature;

use App\Models\Favorite;
use App\Models\Restaurant;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;

class FavoriteTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */

     /**
      * @test
      */
    public function it_adds_a_favorite()
    {
        //create the user
       $user = User::factory()->create();

       //create the diner
       $diner = Restaurant::factory()->create();

       //create the data to be sent
       $input = [
        'user_id' => $user,
        'restaurant_id' => $diner
       ];

       //authenticate user
       Passport::actingAs($user);


       //send in a response
       $response = $this->json('POST', route('favorites.store', $input));

       $response->assertStatus(201);
    }

    //delete a favorite

    /**
     * @test
     */
    public function it_delete_a_user_favorite()
    {
        //create the user
        $user = User::factory()->create();

        //create the restaurant
        //$diner = Restaurant::factory()->create();

        //add to favorites
        $favorite = Favorite::factory()->create();

        //dd($favorite);
        //authenticate a user
        Passport::actingAs($user);

        $response = $this->json('DELETE', route('favorites.destroy', $favorite));

        $response->assertStatus(200);

    }
}
