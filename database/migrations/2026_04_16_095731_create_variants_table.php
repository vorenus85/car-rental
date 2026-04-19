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
        //

        Schema::create('variants', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();

            $table->foreignId('model_id')
                ->constrained('car_models')
                ->restrictOnDelete();

            $table->string('name');
            $table->enum('category', ['economy', 'compact', 'suv', 'business', 'premium']);
            $table->text('description')->nullable();

            $table->enum('body_type', ['suv', 'sedan', 'hatchback', 'coupe', 'wagon']);
            $table->enum('transmission', ['manual', 'automatic']);
            $table->enum('fuel', ['petrol', 'diesel', 'electric', 'hybrid']);

            $table->integer('seats');
            $table->integer('doors');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('variants');
    }
};
