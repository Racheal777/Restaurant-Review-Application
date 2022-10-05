<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

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

        $this->actingAs($user);
      
        //Post method, the route path and the data its getting
        $response = $this->json('POST', route('users.login', $input));
        //passing the data to help authentication
        
        $response
        ->assertStatus(200)
        ;
       

        
     }
}
