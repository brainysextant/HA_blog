<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger("brand_id");
            $table->unsignedBigInteger("car_model_id");
            $table->text("description");
            $table->year('year');
            $table->unsignedInteger("price_usd");
            $table->string("image");
            $table->tinyInteger("status")->default(0);
            $table->tinyInteger("rating")->default(5);
            $table->timestamps();

            
            // Documentación: https://laravel.com/docs/master/migrations#foreign-key-constraints
            
            $table->foreign('brand_id')
                ->references('id')->on('brands')
                ->onDelete('cascade');

            $table->foreign('car_model_id')
                ->references('id')->on('car_models')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cars');
    }
}
