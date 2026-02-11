<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->unsignedBigInteger('model_id');
            $table->string('licence_plate')->unique();
            $table->string('image');
            $table->integer('price_per_day');
            $table->string('status'); // ['available', 'unavailable', 'maintenance']
            $table->string('body_type'); // ['suv', 'sedan', 'hatchback', 'coupe', 'convertible', 'truck', 'van', 'wagon', 'crossover', 'minivan']
            $table->string('transmission'); // ['automatic', 'manual']
            $table->string('fuel'); // ['petrol', 'diesel', 'eletric', 'hybrid']
            $table->unsignedBigInteger('color_id');
            $table->integer('production_year');
            $table->integer('top_speed');
            $table->decimal('acceleration', 4, 1);
            $table->integer('range');
            $table->text('description')->nullable();
            $table->timestamps();

            $table->foreign('model_id')->references('id')->on('car_models');
            $table->foreign('color_id')->references('id')->on('colors');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
