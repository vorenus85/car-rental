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
        //

        Schema::create('car_variants', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();

            $table->foreignId('model_id')
                ->constrained('car_models')
                ->cascadeOnDelete();

            $table->string('name');
            $table->string('category');
            $table->text('description')->nullable();

            $table->enum('body_type', ['suv', 'sedan', 'hatchback', 'coupe', 'wagon']);
            $table->enum('transmission', ['manual', 'automatic']);
            $table->enum('fuel', ['petrol', 'diesel', 'electric', 'hybrid']);

            $table->integer('top_speed')->nullable();
            $table->decimal('acceleration', 4, 1)->nullable();
            $table->integer('range')->nullable();

            $table->integer('seats')->nullable();
            $table->integer('doors')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('car_variants');
    }
};
