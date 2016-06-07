<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RestaurantOwnerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }
    
    public function test_non_owner_cannot_add_restaurant()
    {
	$user = factory(App\User::class)->create();

	$this->actingAs($user)
	    ->visit('/restaurantOwner/addRestaurant')
	    ->seePageIs('/');
    }
    public function test_owner_can_add_restaurant()
    {
        $user = factory(App\User::class, 'owner')->create();
        
	$this->actingAs($user)
	    ->visit('/restaurantOwner/addRestaurant')
	    ->type('Test Restaurant', 'name')
	    ->type('Test Location', 'location')
	    ->type('email@test.com', 'email')
	    ->type('1234', 'Contact')
	    ->type('This is a test', 'description')
	    ->press('Add')
	    ->seePageIs('/account')
	    ->seeInDatabase('restaurant', ['name' => 'Test Restaurant']);
    }

}
