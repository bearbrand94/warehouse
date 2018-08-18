<?php

use Illuminate\Database\Seeder;
use App\Item;
use App\Worktype;

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
        Worktype::truncate();
        
        $faker = \Faker\Factory::create();

        $arrUnitName=['Pallete', 'Box'];

        // And now let's generate a few dozen users for our app:
        for ($i = 0; $i < 30; $i++) {
            $itemdata = Item::create([
            	'client_id' => $faker->numberBetween(1,30),
                'name' => $faker->domainWord,
                'unit_name' => $arrUnitName[$faker->numberBetween(0,0)],
                'qty' => 0,
            ]);
            Worktype::create([
                'item_id' => $itemdata->id,
                'name' => "bongkar",
                'price' => 15000,
            ]);
            Worktype::create([
                'item_id' => $itemdata->id,
                'name' => "muat",
                'price' => 15000,
            ]);
            Worktype::create([
                'item_id' => $itemdata->id,
                'name' => "penitipan",
                'price' => 7500,
            ]);
        }
    }
}
