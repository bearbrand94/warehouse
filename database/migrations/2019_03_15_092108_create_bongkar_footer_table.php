<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBongkarFooterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bongkar_footer', function (Blueprint $table) {
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
        Schema::dropIfExists('bongkar_footer');
    }
}
