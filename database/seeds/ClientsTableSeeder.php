<?php

use Illuminate\Database\Seeder;
use App\Client;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Client::truncate();

        $faker = \Faker\Factory::create();

        // And now let's generate a few dozen users for our app:
        for ($i = 0; $i < 30; $i++) {
            Client::create([
            	'name' => $faker->name,
                'email' => $faker->email,
                'address' => $faker->address,
                'phone1' => $faker->phoneNumber,
                'phone2' => $faker->phoneNumber,
            ]);
        }
    }
}
