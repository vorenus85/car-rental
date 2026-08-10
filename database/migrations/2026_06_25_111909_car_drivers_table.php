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
        Schema::create('car_drivers', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');

            $table->string('email');
            $table->string('phone');

            $table->date('birth_date');

            $table->char('country', 2);
            $table->string('city');
            $table->string('postal_code', 20);
            $table->string('address_line_1');
            $table->string('address_line_2')->nullable();

            $table->string('licence_number');
            $table->char('licence_country', 2);
            $table->date('licence_issue_date');
            $table->date('licence_expiry_date');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('car_drivers');
    }
};
