<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('district');
            $table->double('phone_number');
            $table->double('code_number');
            $table->double('due_amount')->default(0);
            $table->string('comp_name');
            $table->string('created_by', 100);
            $table->foreign('created_by')->references('username')->on('users')->onUpdate('cascade');
            $table->string('modified_by', 100)->nullable();
            $table->foreign('modified_by')->references('username')->on('users')->onUpdate('cascade');
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
        Schema::dropIfExists('customers');
    }
}
