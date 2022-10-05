<?php

namespace Tests\Feature;

use App\Models\Restaurant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DinerTest extends TestCase
{

    use RefreshDatabase;
    /**
     * @test
     */
    public function it_lists_all_diners()
    {
        Restaurant::factory(2)->create();

        $response = $this->json('GET', route('diners.index'));

        $response->assertJsonCount(2, 'data');
        $response->assertStatus(200);
    }

    /**
     * @test
     */

     //feature test
    public function it_creates_a_diner()
    {
       
        $input = [
            'name' => fake()->name(),
            'contact' => fake()->phoneNumber(),
            'website_url' => fake()->url(),
            'about' => fake()->paragraph(),
            'location' => fake()->address(),
            'category' => fake()->randomElement(['All', 'Continental', 'Local']),
            'working_hours' => fake()->time(),
            'images' => fake()->image(),
            'profileimage' => fake()->image()
        ];
        $response = $this->json('POST', route('diners.store'), $input);
        $response
        ->assertStatus(200)
        ->assertJsonFragment([
            'about' => $input['about']
        ]);
    }


    /**
     * @test
     */

     public function it_list_one_diner()
     {
        $diner = Restaurant::factory()->create();

        $response = $this->json('GET', route('diners.show',  $diner));

        $response->assertStatus(200);

     }

     /**
      * @test
      */

      //delete test
      public function it_deletes_one_diner()
      {
         $diner1 = Restaurant::factory()->create();
         //$diner12= Restaurant::factory()->create();
 
         $response = $this->json('DELETE', route('diners.destroy',  $diner1));
 
         $response->assertStatus(200);
 
      }
        
      /**
     * @test
     */

     //feature test
    public function it_updates_a_diner()
    {
        $diner1 = Restaurant::factory()->create();
        $input = [
            'name' => fake()->name(),
            'contact' => fake()->phoneNumber(),
           
        ];
        $response = $this->json('PATCH', route('diners.update', $diner1), $input);
        //dd($response);
        $response
        ->assertStatus(200)
        ;
    }
        


}
