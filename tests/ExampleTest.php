<?php
use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    /*public function testBasicExample()
    {
        $this->visit('/')
             ->see('Laravel 5');
    }
    */
    public function test_owner_can_add_restaurant()
    {
        $user = factory(App\User::class, 'owner')->create();
        
	$this->visit('/restaurantOwner/addRestaurant')
	    ->type('Test Restaurant', 'name')
	    ->type('Test Location', 'location')
	    ->type('email@test.com', 'email')
	    ->type('This is a test', 'description')
	    ->press('Add')
            ->seeInDatabase('restaurant', ['name' => 'Test Restaurant']);
    }
}
