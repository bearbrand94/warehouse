<?php

use Illuminate\Database\Seeder;
use App\Item;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Item::truncate();

        $faker = \Faker\Factory::create();

        // And now let's generate a few dozen users for our app:
        for ($i = 0; $i < 30; $i++) {
            Item::create([
            	'client_id' => $faker->name,
                'name' => $faker->email,
                'unit_name' => $faker->address,
                'qty' => $faker->phoneNumber,
            ]);
        }
    }
}
