<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMuatHeaderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('muat_header', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id')->unsigned();
            $table->string('droporder_id')->nullable();
            $table->string('truck_number');
            $table->datetime('delivered_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('muat_header');
    }
}
