<?php

use Illuminate\Database\Seeder;
use App\Itemlog;

class ItemlogsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Itemlog::truncate();
        
        $faker = \Faker\Factory::create();

        $arrUnitName=['Pallete', 'Box'];

        // And now let's generate a few item data for each client:
        for ($z = 1; $z < 31; $z++) {
            for ($i = 0; $i < $faker->numberBetween(1,5); $i++) {
                // $itemdata = Itemlog::create([
                // 	'client_id' => $z,
                //     'name' => $faker->domainWord,
                //     'unit_name' => $arrUnitName[$faker->numberBetween(0,0)],
                //     'qty' => 0,
                // ]);
                Single_fee::create([
                    'item_id' => $itemdata->id,
                    'name' => "bongkar",
                    'price' => 15000,
                ]);
                Single_fee::create([
                    'item_id' => $itemdata->id,
                    'name' => "muat",
                    'price' => 15000,
                ]);
                Recurring_fee::create([
                    'item_id' => $itemdata->id,
                    'name' => "penitipan",
                    'price' => 7500,
                    'recurring_type' => "half month"
                ]);
            }
        }
    }
}
