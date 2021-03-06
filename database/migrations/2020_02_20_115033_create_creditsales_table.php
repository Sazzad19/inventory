<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCreditsalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('creditsales', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('customer_id')->unsigned();
          $table->foreign('customer_id')->references('id')->on('customers')->onUpdate('cascade')->onDelete('cascade');
          $table->integer('product_id')->unsigned();
          $table->foreign('product_id')->references('id')->on('products')->onUpdate('cascade')->onDelete('cascade');
          $table->integer('quantity');
          $table->double('price');
          $table->string('saller_name');
          $table->boolean('sales_status')->default(1);
          $table->dateTime('sales_date');
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
        Schema::dropIfExists('creditsales');
    }
}
