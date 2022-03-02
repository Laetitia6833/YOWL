<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBasketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('baskets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('producteur_id');
            $table->foreign('producteur_id')->references('id')->on('producteurs');
            $table->text('content')->nullable();
            $table->float('price')->nullable();
            $table->integer('quantity')->nullable();
            $table->text('image_path')->nullable();
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
        Schema::dropIfExists('baskets');
    }
}
