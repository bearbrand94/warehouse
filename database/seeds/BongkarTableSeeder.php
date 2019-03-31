<?php

use Illuminate\Database\Seeder;
use App\Bongkar_header;
use App\Bongkar_footer;

class BongkarTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bongkar_header::truncate();
        Bongkar_footer::truncate();
    }
}
