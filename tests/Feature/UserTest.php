<?php

namespace Tests\Feature;

use App\Models\Favorite;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;

class UserTest extends TestCase
{

    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    // public function setUp(): void
    // {
    //     parent::setUp();
    //     Artisan::call('passport:install');
    // }

    //this function will run anytime the test is run to help  create the token for the user
    public function setUp():void{
        parent::setUp();
        Artisan::call('passport:install');
    }
    /**
     * @test
     */

     //function for signup test
    public function it_signup_a_user()
    {
       
       //input for the register function 
        $input = [
            'name' => fake()->name(),
            'email' => fake()->safeEmail(),
            'username' => fake()->userName(),
            'password' => fake()->password(),
            'password_confirmation' => 'password',
        ];

        $response = $this->json('POST', route('users.create', $input));

        $response
        ->assertStatus(200)
        ->assertJsonFragment([
            'name' => $input['name']
        ]);
    }


    /**
     * @test
     */

     //function for logging a user in
     public function it_logs_in_a_user()
     {
        //create a user with the factory 
        $user = User::factory()->create();

        //credentials from the user to enable login
        $input =[
            'email' => $user->email,
            'password' => 'password',
        ];

        //Passport::actingAs($user);
        $this->actingAs($user);
      
        //Post method, the route path and the data its getting
        $response = $this->json('POST', route('users.login', $input));
        //passing the data to help authentication
        
        $response
        ->assertStatus(200)
        ;
       

        
     }

     /**
      * @test
      */
      //function for testing a user favorites

      public function it_fetches_a_user_favorites()
      {
        //create the user
        $user = User::factory()->create();

        //create a favorite
        $favorite = Favorite::factory()->create();

        //authenticate the user
        Passport::actingAs($user);

        //get the response
        $response = $this->json('GET', route('userfavorites'));

        $response
        ->assertStatus(200);
      }

      
}
