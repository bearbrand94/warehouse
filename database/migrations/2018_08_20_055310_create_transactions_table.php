<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id')->unsigned();
            $table->integer('item_id')->unsigned();
            $table->integer('ref_id')->unsigned();
            $table->string('ref_table_name');
            $table->integer('qty');
            $table->integer('nominal');
            $table->string('note');
            $table->string('desc');
            $table->timestamps();
            $table->softDeletes();
            
            // $table->foreign('client_id')->references('id')->on('clients');
            // $table->foreign('item_id')->references('id')->on('items');
            // $table->foreign('worktype_id')->references('id')->on('worktypes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
