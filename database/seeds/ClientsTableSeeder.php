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
        Client::create([
            'name' => "Wijaya",
            'email' => $faker->email,
            'address' => $faker->address,
            'phone1' => $faker->phoneNumber,
            'phone2' => $faker->phoneNumber,
        ]);
        Client::create([
            'name' => "Rizky / Rachmat Santoso",
            'email' => $faker->email,
            'address' => $faker->address,
            'phone1' => $faker->phoneNumber,
            'phone2' => $faker->phoneNumber,
        ]);
        Client::create([
            'name' => "Madu",
            'email' => $faker->email,
            'address' => $faker->address,
            'phone1' => $faker->phoneNumber,
            'phone2' => $faker->phoneNumber,
        ]);
        Client::create([
            'name' => "Koh Ming/ CV. Morodadi",
            'email' => $faker->email,
            'address' => $faker->address,
            'phone1' => $faker->phoneNumber,
            'phone2' => $faker->phoneNumber,
        ]);
        Client::create([
            'name' => "Jiwen",
            'email' => $faker->email,
            'address' => $faker->address,
            'phone1' => $faker->phoneNumber,
            'phone2' => $faker->phoneNumber,
        ]);
        Client::create([
            'name' => "Indrawati",
            'email' => $faker->email,
            'address' => $faker->address,
            'phone1' => $faker->phoneNumber,
            'phone2' => $faker->phoneNumber,
        ]);
        Client::create([
            'name' => "Iwan / UD. Bintang Mulia",
            'email' => $faker->email,
            'address' => $faker->address,
            'phone1' => $faker->phoneNumber,
            'phone2' => $faker->phoneNumber,
        ]);
        Client::create([
            'name' => "Grandy",
            'email' => $faker->email,
            'address' => $faker->address,
            'phone1' => $faker->phoneNumber,
            'phone2' => $faker->phoneNumber,
        ]);
        Client::create([
            'name' => "Gading Asia",
            'email' => $faker->email,
            'address' => $faker->address,
            'phone1' => $faker->phoneNumber,
            'phone2' => $faker->phoneNumber,
        ]);
        Client::create([
            'name' => "Arif",
            'email' => $faker->email,
            'address' => $faker->address,
            'phone1' => $faker->phoneNumber,
            'phone2' => $faker->phoneNumber,
        ]);
        Client::create([
            'name' => "Sinar Abadi Printing",
            'email' => $faker->email,
            'address' => $faker->address,
            'phone1' => $faker->phoneNumber,
            'phone2' => $faker->phoneNumber,
        ]);
        Client::create([
            'name' => "Eva / Berkah Jaya",
            'email' => $faker->email,
            'address' => $faker->address,
            'phone1' => $faker->phoneNumber,
            'phone2' => $faker->phoneNumber,
        ]);
    }
}
