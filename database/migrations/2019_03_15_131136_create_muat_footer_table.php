<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMuatFooterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('muat_footer', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('header_id')->unsigned();
            $table->integer('item_id')->unsigned();
            $table->integer('qty');
            $table->string('note')->nullable();
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
        Schema::dropIfExists('muat_footer');
    }
}
