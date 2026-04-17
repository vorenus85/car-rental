<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();

            $table->foreignId('variant_id')
                ->constrained('variants')
                ->restrictOnDelete();

            $table->string('licence_plate')->unique();

            $table->integer('price_per_day');
            $table->enum('status', ['available', 'unavailable', 'maintenance']);

            $table->integer('production_year');
            $table->integer('mileage');

            $table->string('image')->nullable();
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
