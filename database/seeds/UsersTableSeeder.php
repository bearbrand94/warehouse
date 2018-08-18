<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Let's clear the users table first
        User::truncate();

        $faker = \Faker\Factory::create();

        // Let's make sure everyone has the same password and 
        // let's hash it before the loop, or else our seeder 
        // will be too slow.
        $password = Hash::make('warehouse');

        User::create([
        	'name' => 'Paulus Wey',
            'email' => 'paulusw.94@gmail.com',
            'password' => $password
        ]);

        // And now let's generate a few users with role number 2
        for ($i = 0; $i < 9; $i++) {
            User::create([
                'email' => $faker->email,
                'name' => $faker->name,
                'password' => $password
            ]);
        }
    }
}

?>