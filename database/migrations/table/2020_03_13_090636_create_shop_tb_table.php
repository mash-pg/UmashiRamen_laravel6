<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopTbTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_tb', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('shop_id')->unique();
            $table->string('password');
            $table->string('email');
            $table->string('area_id');
            $table->string('shop_name');
            $table->string('shop_tel');
            $table->string('shop_address');
            $table->integer('seat');
            $table->integer('show_data');
            $table->enum('dlflag',['1','2','3']);
            $table->string('avarage_price');
            $table->string('comments');
            $table->string('img');
            $table->string('img1');
            $table->string('img2');
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
        Schema::dropIfExists('shop_tb');
    }
}
