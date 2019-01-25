<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Itemlog;

class CreateItemlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itemlogs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('item_id')->unsigned();
            $table->integer('fee_ref_id')->unsigned();
            $table->integer('qty')->default(0)->nullable();
            $table->string('note')->nullable();
            $table->timestamps();
            $table->softDeletes();

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
        Schema::dropIfExists('itemlogs');
    }
}
