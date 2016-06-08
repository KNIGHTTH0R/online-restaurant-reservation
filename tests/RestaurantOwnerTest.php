<?php

use App\Restaurant;
use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RestaurantOwnerTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     */
    /*
    public function testExample()
    {
        $this->assertTrue(true);
    }
    */
    
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

    public function test_owner_can_update_restaurant()
    {
        $owner = factory(App\User::class, 'owner')->create();

        $owner->restaurants()->save($restaurant = factory(App\Restaurant::class)->create(['owner_id' => $owner->id]));

        $this->actingAs($owner)
            ->visit('/account')
            ->see($restaurant->name)
            ->click('Update '.$restaurant->name)
            ->see('Update Existing Tables')
            ->type('Dhanmondi', 'location')
            ->press('Update General Info')
            ->seeInDatabase('restaurant', ['name' => 'Test Restaurant', 'location' => 'Dhanmondi']);

    }

    public function test_owner_can_add_table()
    {
        $owner = factory(App\User::class, 'owner')->create();

        $owner->restaurants()->save($restaurant = factory(App\Restaurant::class)->create(['owner_id' => $owner->id]));

        $this->actingAs($owner)
            ->visit('/account')
            ->click('Update '.$restaurant->name)
            ->type('10', 'new_capacity')
            ->type('1000', 'new_booking_fee')
            ->type('1', 'new_num_of_tables')
            ->press('Add Table')
            ->seeInDatabase('restaurant_table', ['capacity' => '10', 'booking_fee' => '1000', 'restaurant_id' => $restaurant->id]);
    }

    public function test_owner_can_add_food_menu()
    {
        $owner = factory(App\User::class, 'owner')->create();

        $owner->restaurants()->save($restaurant = factory(App\Restaurant::class)->create(['owner_id' => $owner->id]));

        $this->actingAs($owner)
            ->visit('/account')
            ->click('Update '.$restaurant->name)
            ->type('Test Menu', 'new_menu_name')
            ->type('1234','new_menu_price')
            ->select('Appetizer', 'new_menu_category')
            ->press('Add Food Menu')
            ->seeInDatabase('food_menu', ['name' => 'Test Menu', 'price' => '1234', 'category' => 'Appetizer', 'restaurant_id' => $restaurant->id]);
    }

}
