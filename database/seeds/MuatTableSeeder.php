<?php

use Illuminate\Database\Seeder;
use App\Muat_header;
use App\Muat_footer;

class MuatTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Muat_header::truncate();
        Muat_footer::truncate();

    }
}
