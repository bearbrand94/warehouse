<?php

use Illuminate\Database\Seeder;
use App\Item;
use App\Single_fee;
use App\Recurring_fee;
use App\Itemlog;
use App\Muat_header;
use App\Muat_footer;
use App\Bongkar_header;
use App\Bongkar_footer;

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
        Recurring_fee::truncate();
        Itemlog::truncate();
        Muat_header::truncate();
        Muat_footer::truncate();

        $faker = \Faker\Factory::create();

        $arrItemName=['HVS 70gr 65x100 @21R APP', 'HVS 70gr 61x86 @21R APP', 'Air Blower', 'Benang', 'CD 50gr 65x100', 'CD 50gr 61x86', 'Benang Warna', 'HVS 58gr PRINT ONE'];
        $arrUnitName=['Palet', 'Pak', 'Dos', 'Karung', 'Peti', 'Roll', 'Sak', 'Unit'];

        $itemdata1 = Item::create([
            'client_id' => 2,
            'name' => 'Karton Yellow Board No. 30 LB',
            'unit_name' => 'Pak',
            'qty' => 570,
        ]);
        $itemdata2 = Item::create([
            'client_id' => 2,
            'name' => 'Yellow Board Q1 350gr 66x78 @10pak',
            'unit_name' => 'Palet',
            'qty' => 0,
        ]);
        $itemdata3 = Item::create([
            'client_id' => 2,
            'name' => 'Yellow Board Q1 200gr 66x78 @15pak',
            'unit_name' => 'Palet',
            'qty' => 3,
        ]);
        $itemdata4 = Item::create([
            'client_id' => 2,
            'name' => 'Yellow Board Q1 450gr 66x78 @10pak',
            'unit_name' => 'Palet',
            'qty' => 0,
        ]);
        $itemdata5 = Item::create([
            'client_id' => 2,
            'name' => 'Yellow Board Q1 400gr 66x78 @10pak',
            'unit_name' => 'Palet',
            'qty' => 0,
        ]);  
        $itemdata6 = Item::create([
            'client_id' => 2,
            'name' => 'Yellow Board Q1 500gr 66x78 @10pak',
            'unit_name' => 'Palet',
            'qty' => 11,
        ]); 
        $itemdata7 = Item::create([
            'client_id' => 2,
            'name' => 'Karton Yellow Board No. 40',
            'unit_name' => 'Pak',
            'qty' => 1022,
        ]); 
        $itemdata8 = Item::create([
            'client_id' => 2,
            'name' => 'Karton Yellow Board No. 30 Super',
            'unit_name' => 'Pak',
            'qty' => 368,
        ]); 

        $muat_header = Muat_header::create([
            'client_id' => 2,
            'droporder_id' => '12.03.19',
            'truck_number' => 'L 8105 PR',
            'delivered_at' => "2019-03-08",
        ]);
            $muat_footer = Muat_footer::create([
                'header_id' => $muat_header->id,
                'item_id' => $itemdata5->id,
                'qty' => 7,
            ]);

        $muat_header = Muat_header::create([
            'client_id' => 2,
            'droporder_id' => '115.02.2019',
            'truck_number' => 'L 8105 PR',
            'delivered_at' => "2019-03-01",
        ]);
            $muat_footer = Muat_footer::create([
                'header_id' => $muat_header->id,
                'item_id' => $itemdata3->id,
                'qty' => 3,
            ]);
            $muat_footer = Muat_footer::create([
                'header_id' => $muat_header->id,
                'item_id' => $itemdata1->id,
                'qty' => 75,
            ]);  

        $bongkar_header = Bongkar_header::create([
            'client_id' => 2,
            'droporder_id' => '1/011719',
            'truck_number' => 'L 9004 NK',
            'delivered_at' => "2019-03-03",
        ]);
            $bongkar_footer = Bongkar_footer::create([
                'header_id' => $bongkar_header->id,
                'item_id' => $itemdata2->id,
                'qty' => 15,
            ]);  
            $bongkar_footer = Bongkar_footer::create([
                'header_id' => $bongkar_header->id,
                'item_id' => $itemdata5->id,
                'qty' => 13,
            ]); 

        $bongkar_header = Bongkar_header::create([
            'client_id' => 2,
            'droporder_id' => '1/011619',
            'truck_number' => 'L 8003 TK',
            'delivered_at' => "2019-03-04",
        ]);
            $bongkar_footer = Bongkar_footer::create([
                'header_id' => $bongkar_header->id,
                'item_id' => $itemdata3->id,
                'qty' => 4,
            ]);

        $bongkar_header = Bongkar_header::create([
            'client_id' => 2,
            'droporder_id' => '1/013319',
            'truck_number' => 'L 8003 TK',
            'delivered_at' => "2019-03-02",
        ]);
            $bongkar_footer = Bongkar_footer::create([
                'header_id' => $bongkar_header->id,
                'item_id' => $itemdata6->id,
                'qty' => 8,
            ]);

        $muat_header = Muat_header::create([
            'client_id' => 2,
            'droporder_id' => '116.03.2019',
            'truck_number' => 'L 8105 PR',
            'delivered_at' => "2019-03-02",
        ]);
            $muat_footer = Muat_footer::create([
                'header_id' => $muat_header->id,
                'item_id' => $itemdata1->id,
                'qty' => 100,
            ]);       

        $muat_header = Muat_header::create([
            'client_id' => 2,
            'droporder_id' => '117.03.2019',
            'truck_number' => 'L 8105 PR',
            'delivered_at' => "2019-03-02",
        ]);
            $muat_footer = Muat_footer::create([
                'header_id' => $muat_header->id,
                'item_id' => $itemdata6->id,
                'qty' => 2,
            ]); 

        $muat_header = Muat_header::create([
            'client_id' => 2,
            'droporder_id' => '118.03.2019',
            'truck_number' => 'L 8105 PR',
            'delivered_at' => "2019-03-04",
        ]);
            $muat_footer = Muat_footer::create([
                'header_id' => $muat_header->id,
                'item_id' => $itemdata1->id,
                'qty' => 28,
            ]); 
            $muat_footer = Muat_footer::create([
                'header_id' => $muat_header->id,
                'item_id' => $itemdata7->id,
                'qty' => 10,
            ]); 
            $muat_footer = Muat_footer::create([
                'header_id' => $muat_header->id,
                'item_id' => $itemdata8->id,
                'qty' => 20,
            ]); 

        $muat_header = Muat_header::create([
            'client_id' => 2,
            'droporder_id' => '119.03.2019',
            'truck_number' => 'L 8105 PR',
            'delivered_at' => "2019-03-05",
        ]);
            $muat_footer = Muat_footer::create([
                'header_id' => $muat_header->id,
                'item_id' => $itemdata3->id,
                'qty' => 1,
            ]); 

        $muat_header = Muat_header::create([
            'client_id' => 2,
            'droporder_id' => '120.03.2019',
            'truck_number' => 'L 8105 PR',
            'delivered_at' => "2019-03-05",
        ]);
            $muat_footer = Muat_footer::create([
                'header_id' => $muat_header->id,
                'item_id' => $itemdata7->id,
                'qty' => 50,
            ]); 

        $muat_header = Muat_header::create([
            'client_id' => 2,
            'droporder_id' => '121.03.2019',
            'truck_number' => 'L 8105 PR',
            'delivered_at' => "2019-03-05",
        ]);
            $muat_footer = Muat_footer::create([
                'header_id' => $muat_header->id,
                'item_id' => $itemdata1->id,
                'qty' => 40,
            ]); 
        $muat_header = Muat_header::create([
            'client_id' => 2,
            'droporder_id' => '122.03.2019',
            'truck_number' => 'L 8105 PR',
            'delivered_at' => "2019-03-06",
        ]);
            $muat_footer = Muat_footer::create([
                'header_id' => $muat_header->id,
                'item_id' => $itemdata7->id,
                'qty' => 10,
            ]);
        $muat_header = Muat_header::create([
            'client_id' => 2,
            'droporder_id' => '123.03.2019',
            'truck_number' => 'L 8105 PR',
            'delivered_at' => "2019-03-06",
        ]);
            $muat_footer = Muat_footer::create([
                'header_id' => $muat_header->id,
                'item_id' => $itemdata8->id,
                'qty' => 10,
            ]); 

        $muat_header = Muat_header::create([
            'client_id' => 2,
            'droporder_id' => '124.03.2019',
            'truck_number' => 'L 8105 PR',
            'delivered_at' => "2019-03-05",
        ]);
            $muat_footer = Muat_footer::create([
                'header_id' => $muat_header->id,
                'item_id' => $itemdata2->id,
                'qty' => 1,
            ]); 
        $muat_header = Muat_header::create([
            'client_id' => 2,
            'droporder_id' => '125.03.2019',
            'truck_number' => 'L 8105 PR',
            'delivered_at' => "2019-03-06",
        ]);
            $muat_footer = Muat_footer::create([
                'header_id' => $muat_header->id,
                'item_id' => $itemdata5->id,
                'qty' => 3,
            ]); 
        $muat_header = Muat_header::create([
            'client_id' => 2,
            'droporder_id' => '126.03.2019',
            'truck_number' => 'L 8105 PR',
            'delivered_at' => "2019-03-06",
        ]);
            $muat_footer = Muat_footer::create([
                'header_id' => $muat_header->id,
                'item_id' => $itemdata6->id,
                'qty' => 2,
            ]);
        $muat_header = Muat_header::create([
            'client_id' => 2,
            'droporder_id' => '109.02.2019',
            'truck_number' => 'L 8105 PR',
            'delivered_at' => "2019-03-02",
        ]);
            $muat_footer = Muat_footer::create([
                'header_id' => $muat_header->id,
                'item_id' => $itemdata6->id,
                'qty' => 4,
            ]);

        // CREATE BENAG IWAN
        $benang1 = Item::create([
            'client_id' => 7,
            'name' => 'P5 Benang 150D/2 Grade B Sulindafin',
            'unit_name' => 'Dus',
            'qty' => 5,
            'created_at' => "2018-08-08"
        ]); 
        $benang2 = Item::create([
            'client_id' => 7,
            'name' => 'P501 Benang 150D AM Sulindafin',
            'unit_name' => 'Dus',
            'qty' => 151,
            'created_at' => "2019-01-14"
        ]); 
        $benang3 = Item::create([
            'client_id' => 7,
            'name' => 'P445 Benang 150D/2 Grade B Sulindafin',
            'unit_name' => 'Dus',
            'qty' => 112,
            'created_at' => "2019-02-15"
        ]); 
        $benang4 = Item::create([
            'client_id' => 7,
            'name' => 'P290 Benang 150D/2 AEM Sulindafin',
            'unit_name' => 'Dus',
            'qty' => 90,
            'created_at' => "2019-02-01"
        ]); 
        $benang5 = Item::create([
            'client_id' => 7,
            'name' => 'P167 Benang 300D AEM Sulindafin',
            'unit_name' => 'Dus',
            'qty' => 81,
            'created_at' => "2019-02-22"
        ]); 
        $benang6 = Item::create([
            'client_id' => 7,
            'name' => 'P56 Benang 300D x(AN) AsiaPasifik',
            'unit_name' => 'Dus',
            'qty' => 56,
            'created_at' => "2018-10-29"
        ]); 
        $benang7 = Item::create([
            'client_id' => 7,
            'name' => 'P100 Benang 300D AEM Sulindafin',
            'unit_name' => 'Dus',
            'qty' => 100,
            'created_at' => "2018-05-11"
        ]); 
        $benang8 = Item::create([
            'client_id' => 7,
            'name' => 'P495 Benang 150D Grade B Sulindafin',
            'unit_name' => 'Dus',
            'qty' => 195,
            'created_at' => "2019-02-06"
        ]);
        $benang9 = Item::create([
            'client_id' => 7,
            'name' => 'P470 Benang 150D AsiaPasifik',
            'unit_name' => 'Dus',
            'qty' => 470,
            'created_at' => "2019-02-21"
        ]); 
        $benang10 = Item::create([
            'client_id' => 7,
            'name' => 'P250 Benang 300D AEM MutuGading',
            'unit_name' => 'Dus',
            'qty' => 43,
            'created_at' => "2019-01-25"
        ]); 
        $benang11 = Item::create([
            'client_id' => 7,
            'name' => 'P465 Benang 300D AsiaPasifik',
            'unit_name' => 'Dus',
            'qty' => 465,
            'created_at' => "2018-10-01"
        ]); 
        $benang12 = Item::create([
            'client_id' => 7,
            'name' => 'P252 Benang 300D A AsiaPasifik',
            'unit_name' => 'Dus',
            'qty' => 57,
            'created_at' => "2019-01-11"
        ]); 
        $benang13 = Item::create([
            'client_id' => 7,
            'name' => 'P164 Benang Polyester Hitam AsiaPasifik',
            'unit_name' => 'Dus',
            'qty' => 0,
        ]); 
        $benang14 = Item::create([
            'client_id' => 7,
            'name' => 'P493 Benang Polyester Hitam AsiaPasifik',
            'unit_name' => 'Dus',
            'qty' => 493,
        ]); 
        $benang15 = Item::create([
            'client_id' => 7,
            'name' => 'P428 Benang 150D AsiaPasifik',
            'unit_name' => 'Dus',
            'qty' => 428,
            'created_at' => "2019-01-23"
        ]); 
        $benang16 = Item::create([
            'client_id' => 7,
            'name' => 'P450 Benang AM Sulindafin',
            'unit_name' => 'Dus',
            'qty' => 450,
            'created_at' => "2019-02-28"
        ]);
        $benang17 = Item::create([
            'client_id' => 7,
            'name' => 'P339 Benang 150D/2 AM Sulindafin',
            'unit_name' => 'Dus',
            'qty' => 234,
            'created_at' => "2019-01-30"
        ]); 
        $benang18 = Item::create([
            'client_id' => 7,
            'name' => 'P168 Benang 300D AsiaPasifik',
            'unit_name' => 'Dus',
            'qty' => 98,
            'created_at' => "2019-02-26"
        ]); 
        $benang19 = Item::create([
            'client_id' => 7,
            'name' => 'P176 Benang 300D A. AsiaPasifik',
            'unit_name' => 'Dus',
            'qty' => 176,
            'created_at' => "2018-10-10"
        ]); 
        $benang20 = Item::create([
            'client_id' => 7,
            'name' => 'P335 Benang 300D/2 AEM Sulindafin',
            'unit_name' => 'Dus',
            'qty' => 125,
            'created_at' => "2019-04-02"
        ]); 
        $benang21 = Item::create([
            'client_id' => 7,
            'name' => 'P175 Benang 100D AM Sulindafin',
            'unit_name' => 'Dus',
            'qty' => 63,
            'created_at' => "2019-02-16"
        ]); 
        $benang22 = Item::create([
            'client_id' => 7,
            'name' => 'P448 Benang 150D STD.A AsiaPasifik',
            'unit_name' => 'Dus',
            'qty' => 448,
            'created_at' => "2019-10-20"
        ]); 
        $benang23 = Item::create([
            'client_id' => 7,
            'name' => 'P224 Benang 300D STD.A AsiaPasifik',
            'unit_name' => 'Dus',
            'qty' => 224,
            'created_at' => "2018-10-29"
        ]); 
        $benang24 = Item::create([
            'client_id' => 7,
            'name' => 'P158 Benang 150D STD.A AsiaPasifik',
            'unit_name' => 'Dus',
            'qty' => 78,
            'created_at' => "2019-02-26"
        ]); 
        $benang25 = Item::create([
            'client_id' => 7,
            'name' => 'P448 Benang 300D AsiaPasifik',
            'unit_name' => 'Dus',
            'qty' => 448,
            'created_at' => "2019-01-23"
        ]); 

        $bongkar_header = Bongkar_header::create([
            'client_id' => 7,
            'droporder_id' => '01/03/2019',
            'truck_number' => 'L 9674 UI',
            'delivered_at' => "2019-03-01",
        ]);
            $bongkar_footer = Bongkar_footer::create([
                'header_id' => $bongkar_header->id,
                'item_id' => $benang13->id,
                'qty' => 164,
            ]);
        $muat_header = Muat_header::create([
            'client_id' => 7,
            'droporder_id' => '01/03/2019',
            'truck_number' => 'L 9240 AY',
            'delivered_at' => "2019-03-01",
        ]);
            $muat_footer = Muat_footer::create([
                'header_id' => $muat_header->id,
                'item_id' => $benang16->id,
                'qty' => 70,
            ]);
        $muat_header = Muat_header::create([
            'client_id' => 7,
            'droporder_id' => '02/03/2019',
            'truck_number' => 'L 9240 AY',
            'delivered_at' => "2019-03-05",
        ]);
            $muat_footer = Muat_footer::create([
                'header_id' => $muat_header->id,
                'item_id' => $benang20->id,
                'qty' => 60,
            ]);
        $muat_header = Muat_header::create([
            'client_id' => 7,
            'droporder_id' => '03/03/2019',
            'truck_number' => 'L 9240 AY',
            'delivered_at' => "2019-03-05",
        ]);
            $muat_footer = Muat_footer::create([
                'header_id' => $muat_header->id,
                'item_id' => $benang2->id,
                'qty' => 100,
            ]);            
        $muat_header = Muat_header::create([
            'client_id' => 7,
            'droporder_id' => '04/03/2019',
            'truck_number' => 'L 9240 AY',
            'delivered_at' => "2019-03-08",
        ]);
            $muat_footer = Muat_footer::create([
                'header_id' => $muat_header->id,
                'item_id' => $benang21->id,
                'qty' => 5,
            ]);

        $benangwarna1 = Item::create([
            'client_id' => 7,
            'name' => 'Benang Polyester Warna Sipatex',
            'unit_name' => 'Dus',
            'qty' => 241,
            'created_at' => "2019-02-28"
        ]); 
        $muat_header = Muat_header::create([
            'client_id' => 7,
            'droporder_id' => '05/03/2019',
            'truck_number' => 'L 9240 AY',
            'delivered_at' => "2019-03-07",
        ]);
            $muat_footer = Muat_footer::create([
                'header_id' => $muat_header->id,
                'item_id' => $benangwarna1->id,
                'qty' => 60,
            ]);

        // CREATE PIGMENT JIWEN
        $pigment1 = Item::create([
            'client_id' => 5,
            'name' => 'CY 152',
            'unit_name' => 'Pack',
            'qty' => 66,
            'created_at' => "2019-02-11"
        ]); 
        $pigment2 = Item::create([
            'client_id' => 5,
            'name' => 'GM-1',
            'unit_name' => 'Pack',
            'qty' => 83,
            'created_at' => "2019-02-11"
        ]); 
        $pigment3 = Item::create([
            'client_id' => 5,
            'name' => 'YC 600',
            'unit_name' => 'Pack',
            'qty' => 101,
            'created_at' => "2019-02-22"
        ]); 
        $pigment4 = Item::create([
            'client_id' => 5,
            'name' => 'CY 181',
            'unit_name' => 'Pack',
            'qty' => 13,
            'created_at' => "2018-07-30"
        ]); 
        $pigment5 = Item::create([
            'client_id' => 5,
            'name' => 'BERMOCELL',
            'unit_name' => 'Pack',
            'qty' => 350,
            'created_at' => "2019-02-19"
        ]); 
        $pigment6 = Item::create([
            'client_id' => 5,
            'name' => 'R 661',
            'unit_name' => 'Pack',
            'qty' => 120,
            'created_at' => "2019-02-19"
        ]); 
        $pigment7 = Item::create([
            'client_id' => 5,
            'name' => 'CY 126',
            'unit_name' => 'Pack',
            'qty' => 20,
            'created_at' => "2019-02-22"
        ]);
        $pigment9 = Item::create([
            'client_id' => 5,
            'name' => 'CY 111',
            'unit_name' => 'Pack',
            'qty' => 40,
            'created_at' => "2019-02-22"
        ]);
        $pigment10 = Item::create([
            'client_id' => 5,
            'name' => 'Hydro Carbon R1100S',
            'unit_name' => 'Pack',
            'qty' => 520,
            'created_at' => "2019-01-18"
        ]);
        $pigment11 = Item::create([
            'client_id' => 5,
            'name' => 'EBM C20Kg',
            'unit_name' => 'Pack',
            'qty' => 96,
            'created_at' => "2019-01-23"
        ]);
        $pigment12 = Item::create([
            'client_id' => 5,
            'name' => 'Hydro Carbon HK1688',
            'unit_name' => 'Pack',
            'qty' => 419,
            'created_at' => "2019-02-07"
        ]);  

        // CREATE BENANG MADU
        $benangmadu1 = Item::create([
            'client_id' => 3,
            'name' => 'P280 80/2 KONGARAR',
            'unit_name' => 'Ball',
            'qty' => 222,
            'created_at' => "2018-11-28"
        ]); 
        $benangmadu2 = Item::create([
            'client_id' => 3,
            'name' => 'P220 80/2 KONGARAR',
            'unit_name' => 'Ball',
            'qty' => 195,
        ]); 
        $benangmadu3 = Item::create([
            'client_id' => 3,
            'name' => 'P50 100/2 HIMALAYA',
            'unit_name' => 'Ball',
            'qty' => 28,
        ]); 
        $benangmadu4 = Item::create([
            'client_id' => 3,
            'name' => 'P59 80/2 GOLDEN PAGODA',
            'unit_name' => 'Ball',
            'qty' => 39,
        ]); 
        $benangmadu5 = Item::create([
            'client_id' => 3,
            'name' => 'P135 64/2 KONGARAR',
            'unit_name' => 'Ball',
            'qty' => 120,
            'created_at' => "2019-01-15"
        ]); 
        $benangmadu6 = Item::create([
            'client_id' => 3,
            'name' => 'P140 80/2 KONGARAR',
            'unit_name' => 'Ball',
            'qty' => 59,
            'created_at' => "2019-01-15"
        ]); 
        $benangmadu7 = Item::create([
            'client_id' => 3,
            'name' => 'P130 64/2 KONGARAR',
            'unit_name' => 'Ball',
            'qty' => 90,
            'created_at' => "2019-01-29"
        ]); 
        $benangmadu8 = Item::create([
            'client_id' => 3,
            'name' => 'P272 40/2 GOLDEN PAGODA',
            'unit_name' => 'Ball',
            'qty' => 270,
            'created_at' => "2018-11-28"
        ]); 
        $muat_header = Muat_header::create([
            'client_id' => 3,
            'droporder_id' => 'MEMO',
            'truck_number' => 'M 8308 UH',
            'delivered_at' => "2019-03-02",
        ]);
            $muat_footer = Muat_footer::create([
                'header_id' => $muat_header->id,
                'item_id' => $benangmadu8->id,
                'qty' => 50,
            ]);

        $printing1 = Item::create([
            'client_id' => 11,
            'name' => 'Casing 70gr 80x100 @12R Jkt',
            'unit_name' => 'Ball',
            'qty' => 3,
            'created_at' => "2019-02-25"
        ]); 
        $printing2 = Item::create([
            'client_id' => 11,
            'name' => 'Kraf Samson 80gr 90x120 @10R UNIPA',
            'unit_name' => 'Ball',
            'qty' => 0,
        ]);  
        $bongkar_header = Bongkar_header::create([
            'client_id' => 7,
            'droporder_id' => 'S0017/3/19',
            'truck_number' => 'N 8526 VC',
            'delivered_at' => "2019-03-09",
        ]);
            $bongkar_footer = Bongkar_footer::create([
                'header_id' => $bongkar_header->id,
                'item_id' => $printing2->id,
                'qty' => 14,
            ]);
        $muat_header = Muat_header::create([
            'client_id' => 3,
            'droporder_id' => '000156',
            'truck_number' => 'L 9372 Z',
            'delivered_at' => "2019-03-02",
        ]);
            $muat_footer = Muat_footer::create([
                'header_id' => $muat_header->id,
                'item_id' => $printing1->id,
                'qty' => 3,
            ]);

        $evabenang1 = Item::create([
            'client_id' => 12,
            'name' => 'Benang 140/2 RED BLOSSOM - Adi Santoso',
            'unit_name' => 'Ball',
            'qty' => 23,
            'created_at' => "2019-02-14"
        ]);  
        $evabenang2 = Item::create([
            'client_id' => 12,
            'name' => 'Benang 210/2 RED BLOSSOM - Berkah Jaya',
            'unit_name' => 'Ball',
            'qty' => 125,
            'created_at' => "2019-02-27"
        ]);  
        $muat_header = Muat_header::create([
            'client_id' => 12,
            'droporder_id' => 'BJ/02/03/ABD/19',
            'truck_number' => 'L 8267 JA',
            'delivered_at' => "2019-03-05",
        ]);
            $muat_footer = Muat_footer::create([
                'header_id' => $muat_header->id,
                'item_id' => $evabenang2->id,
                'qty' => 25,
            ]);
        $muat_header = Muat_header::create([
            'client_id' => 12,
            'droporder_id' => 'AS/31/03/ABD/19',
            'truck_number' => 'L 8267 JA',
            'delivered_at' => "2019-03-05",
        ]);
            $muat_footer = Muat_footer::create([
                'header_id' => $muat_header->id,
                'item_id' => $evabenang1->id,
                'qty' => 23,
            ]);

        $wijaya1 = Item::create([
            'client_id' => 1,
            'name' => 'Yellow Grease',
            'unit_name' => 'Drum',
            'qty' => 4,
            'created_at' => "2019-02-27"
        ]);  
        $wijaya2 = Item::create([
            'client_id' => 1,
            'name' => 'Drum Hitam',
            'unit_name' => 'Drum',
            'qty' => 2,
            'created_at' => "2019-02-06"
        ]);  
        $bongkar_header = Bongkar_header::create([
            'client_id' => 1,
            'droporder_id' => '87/2019',
            'truck_number' => '-',
            'delivered_at' => "2019-03-05",
        ]);
            $bongkar_footer = Bongkar_footer::create([
                'header_id' => $bongkar_header->id,
                'item_id' => $wijaya1->id,
                'qty' => 6,
            ]);

        // INDRAWATI ITEMS
        $indrawati1 = Item::create([
            'client_id' => 6,
            'name' => 'HVS 70gr 65x100 @21R NBApp',
            'unit_name' => 'Ball',
            'qty' => 9,
            'created_at' => "2019-03-01"
        ]); 
        $indrawati2 = Item::create([
            'client_id' => 6,
            'name' => 'HVS 58gr 65x100 @26R PrintOne',
            'unit_name' => 'Ball',
            'qty' => 40,
            'created_at' => "2019-03-01"
        ]); 
        $indrawati3 = Item::create([
            'client_id' => 6,
            'name' => 'HVS 58gr 65x100 @22R Istana',
            'unit_name' => 'Ball',
            'qty' => 54,
            'created_at' => "2019-03-01"
        ]); 
        $indrawati4 = Item::create([
            'client_id' => 6,
            'name' => 'HVS 70gr 65x100 @21R App',
            'unit_name' => 'Ball',
            'qty' => 7,
            'created_at' => "2019-03-01"
        ]); 
        $muat_header = Muat_header::create([
            'client_id' => 6,
            'droporder_id' => '01/03/2019',
            'truck_number' => 'L 8763 VE',
            'delivered_at' => "2019-03-01",
        ]);
            $muat_footer = Muat_footer::create([
                'header_id' => $muat_header->id,
                'item_id' => $indrawati3->id,
                'qty' => 14,
            ]);
        $muat_header = Muat_header::create([
            'client_id' => 6,
            'droporder_id' => '02/03/2019',
            'truck_number' => 'L 8763 VE',
            'delivered_at' => "2019-03-01",
        ]);
            $muat_footer = Muat_footer::create([
                'header_id' => $muat_header->id,
                'item_id' => $indrawati1->id,
                'qty' => 7,
            ]);
            $muat_footer = Muat_footer::create([
                'header_id' => $muat_header->id,
                'item_id' => $indrawati4->id,
                'qty' => 7,
            ]);
        $muat_header = Muat_header::create([
            'client_id' => 6,
            'droporder_id' => '03/03/2019',
            'truck_number' => 'L 9784 VA',
            'delivered_at' => "2019-03-05",
        ]);
            $muat_footer = Muat_footer::create([
                'header_id' => $muat_header->id,
                'item_id' => $indrawati2->id,
                'qty' => 6,
            ]);
            $muat_footer = Muat_footer::create([
                'header_id' => $muat_header->id,
                'item_id' => $indrawati1->id,
                'qty' => 2,
            ]);
        $muat_header = Muat_header::create([
            'client_id' => 6,
            'droporder_id' => '04/03/2019',
            'truck_number' => 'L 8763 VE',
            'delivered_at' => "2019-03-01",
        ]);
            $muat_footer = Muat_footer::create([
                'header_id' => $muat_header->id,
                'item_id' => $indrawati2->id,
                'qty' => 10,
            ]);
        $bongkar_header = Bongkar_header::create([
            'client_id' => 6,
            'droporder_id' => '87/2019',
            'truck_number' => '-',
            'delivered_at' => "2019-03-05",
        ]);
            $bongkar_footer = Bongkar_footer::create([
                'header_id' => $bongkar_header->id,
                'item_id' => $wijaya1->id,
                'qty' => 6,
            ]);

        // KO MING ITEMS
        $koming1 = Item::create([
            'client_id' => 4,
            'name' => 'HVS 58gr 65x100 @26R PrintOne',
            'unit_name' => 'Ball',
            'qty' => 39,
            'created_at' => "2019-03-01"
        ]); 
        $koming2 = Item::create([
            'client_id' => 4,
            'name' => 'HVS 58gr 61x86 @26R PrintOne',
            'unit_name' => 'Ball',
            'qty' => 10,
            'created_at' => "2019-03-01"
        ]);

        // // And now let's generate a few items for our app:
        // for ($i = 0; $i < 50; $i++) {

        //     //first lets create the item data
        //     $itemdata = Item::create([
        //     	'client_id' => $faker->numberBetween(1,30),
        //         'name' => $arrItemName[$faker->numberBetween(0,7)],
        //         'unit_name' => $arrUnitName[$faker->numberBetween(0,7)],
        //         'qty' => 0,
        //     ]);

        //     //there are 3 default worktypes of item:
        //     //bongkar       : fee of unloading item from client to warehouse.
        //     //muat          : fee of loading item from warehouse to client.
        //     //penitipan     : storage fee.

        //     //then create the item worktype of unloading item from client(fee)
        //     $fee_bongkar = Single_fee::create([
        //         'item_id' => $itemdata->id,
        //         'name' => "bongkar",
        //         'price' => 15000,
        //     ]);

        //     //create random itemlog for unloading item between 1 to 20 rows
        //     for ($j = 0; $j < $faker->numberBetween(1,20); $j++) {
        //         $itemlog = Itemlog::create([
        //             'item_id' => $itemdata->id,
        //             'fee_ref_id' => $fee_bongkar->id,
        //             'qty' => $faker->numberBetween(1,10),
        //             'note' => "bongkar",
        //             'type' => "addition"
        //         ]);
        //     }

        //     //create another item worktype of loading item to client(fee)
        //     $fee_muat = Single_fee::create([
        //         'item_id' => $itemdata->id,
        //         'name' => "muat",
        //         'price' => 15000,
        //     ]);

        //     //create random itemlog for loading item with random quantity, but no higher than current item qty.
        //     $item_after_insert = Item::find($itemdata->id);
        //     $itemlog = Itemlog::create([
        //         'item_id' => $itemdata->id,
        //         'fee_ref_id' => $fee_muat->id,
        //         'qty' => $faker->numberBetween(1, $item_after_insert->qty),
        //         'note' => "muat",
        //         'type' => "subtraction"
        //     ]);

        //     //create worktype of storage fee
        //     $fee_penitipan = Recurring_fee::create([
        //         'item_id' => $itemdata->id,
        //         'name' => "penitipan",
        //         'price' => 7500,
        //         'recurring_type' => "monthly"
        //     ]);
        // }
    }
}
