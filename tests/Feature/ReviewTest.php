<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Restaurant;
use App\Models\Review;
use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReviewTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

     //this function will run anytime the test is run to help  create the token for the user
    public function setUp():void{
        parent::setUp();
        Artisan::call('passport:install');
    }
    
    
    /**
     * @test
     */

     public function it_creates_a_review()
     {
        //create the diner first
        $diner = Restaurant::factory()->create();

        //create the user adding the review
        $user = User::factory()->create();
        //input for the review
        $input =  [
            'comment' => 'food is nice',
            'ratings' => 3,
            'restaurant_id' => $diner->id,
            'user_id' => $user->id

        ];

        //authenticate user
        Passport::actingAs($user);
       // $this->assertAuthenticated();
        //$this->actingAs($user);
        $this->assertAuthenticatedAs($user);

        //check the request
        $response = $this->json('POST', route('reviews.store', $input));
       //  dd($response);

        $response
        ->assertStatus(201)
        ->assertJsonFragment([
            'comment' => $input['comment']
        ]);


     }


     /**
      * @test
      */
     //update test
     public function it_updates_a_review()
     {
        $review = Review::factory()->create();

        $diner = Restaurant::factory()->create();

       

        //create the user adding the review
        $user = User::factory()->create();

        //create a review
       


        $input =  [
            'comment' => 'food is great',
            'restaurant_id' => $diner->id,
            'user_id' => $user->id

        ];  

        Passport::actingAs($user);
        $this->assertAuthenticatedAs($user);


        $response = $this->json('PATCH', route('reviews.update', $review), $input);

        $response
        ->assertStatus(200)
        ->assertJsonFragment([
            'comment' => $input['comment']
        ]);

    }
}
