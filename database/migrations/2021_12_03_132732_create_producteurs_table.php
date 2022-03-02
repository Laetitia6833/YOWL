<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProducteursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producteurs', function (Blueprint $table) {
            $table->id();
            $table->string('business_name');
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->string('phone');
            $table->unsignedBigInteger('location_id');
            $table->foreign('location_id')->references('id')->on('locations');
            $table->text('adress');
            $table->boolean('casier');
            $table->integer('note');
            $table->text('description');
            $table->boolean('bio');
            $table->string('link');
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
        Schema::dropIfExists('producteurs');
    }
}
