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
        Schema::create('customer_billing_infos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('customer_id')
                ->constrained()
                ->cascadeOnDelete()
                ->unique();

            // Billing
            $table->string('name');
            $table->char('country', 3)->default('HU');
            $table->string('postcode');
            $table->string('city');
            $table->string('address');

            // Company (optional)
            $table->string('company_name')->nullable();
            $table->string('tax_number')->nullable();
            $table->string('eu_vat_number')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_billing_infos');
    }
};
