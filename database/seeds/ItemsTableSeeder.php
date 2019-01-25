<?php

use Illuminate\Database\Seeder;
use App\Item;
use App\Single_fee;
use App\Itemlog;

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
        Single_fee::truncate();
        Itemlog::truncate();

        $faker = \Faker\Factory::create();

        $arrItemName=['HVS 70gr 65x100 @21R APP', 'HVS 70gr 61x86 @21R APP', 'Air Blower', 'Benang', 'CD 50gr 65x100', 'CD 50gr 61x86', 'Benang Warna', 'HVS 58gr PRINT ONE'];
        $arrUnitName=['Palet', 'Pak', 'Dos', 'Karung', 'Peti', 'Roll', 'Sak', 'Unit'];

        // And now let's generate a few items for our app:
        for ($i = 0; $i < 50; $i++) {

            //first lets create the item data
            $itemdata = Item::create([
            	'client_id' => $faker->numberBetween(1,30),
                'name' => $arrItemName[$faker->numberBetween(0,7)],
                'unit_name' => $arrUnitName[$faker->numberBetween(0,7)],
                'qty' => 0,
            ]);

            //there are 3 default worktypes of item:
            //bongkar       : fee of unloading item from client to warehouse.
            //muat          : fee of loading item from warehouse to client.
            //penitipan     : storage fee.

            //then create the item worktype of unloading item from client(fee)
            $worktype_in = Single_fee::create([
                'item_id' => $itemdata->id,
                'name' => "bongkar",
                'price' => 15000,
            ]);

            //create random itemlog for unloading item between 1 to 20 rows
            for ($j = 0; $j < $faker->numberBetween(1,20); $j++) {
                $itemlog = Itemlog::create([
                    'item_id' => $itemdata->id,
                    'worktype_id' => $worktype_in->id,
                    'qty' => $faker->numberBetween(1,10),
                ]);
            }

            //create another item worktype of loading item to client(fee)
            $worktype_out = Single_fee::create([
                'item_id' => $itemdata->id,
                'name' => "muat",
                'price' => 15000,
            ]);

            //create random itemlog for loading item with random quantity, but no higher than current item qty.
            $item_after_insert = Item::find($itemdata->id);
                $itemlog = Itemlog::create([
                    'item_id' => $itemdata->id,
                    'worktype_id' => $worktype_out->id,
                    'qty' => $faker->numberBetween(-1, $item_after_insert->qty*-1),
                ]);

            //create worktype of storage fee
            Single_fee::create([
                'item_id' => $itemdata->id,
                'name' => "penitipan",
                'price' => 7500,
            ]);
        }
    }
}
