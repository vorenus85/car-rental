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
            $table->foreignId('model_id')->nullable()->constrained('car_models')->nullOnDelete();
            $table->string('licence_plate')->unique();
            $table->string('image');
            $table->integer('price_per_day');
            $table->string('status'); // ['available', 'unavailable', 'maintenance']
            $table->string('body_type'); // ['suv', 'sedan', 'hatchback', 'coupe', 'convertible', 'truck', 'van', 'wagon', 'crossover', 'minivan']
            $table->string('transmission'); // ['automatic', 'manual']
            $table->string('fuel'); // ['petrol', 'diesel', 'eletric', 'hybrid']
            $table->foreignId('color_id')->nullable()->constrained('colors')->nullOnDelete();
            $table->integer('production_year');
            $table->integer('top_speed');
            $table->decimal('acceleration', 4, 1);
            $table->integer('range');
            $table->text('description')->nullable();
            $table->timestamps();

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
