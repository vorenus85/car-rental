<?php

use App\Enums\BookingStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();

            $table->string('booking_number')->unique();

            $table->foreignId('customer_id')->constrained()->cascadeOnDelete();
            $table->foreignId('car_id')->constrained()->cascadeOnDelete();

            $table->foreignId('pickup_location_id')->constrained('locations');
            $table->foreignId('dropoff_location_id')->constrained('locations');

            $table->dateTime('pickup_at');
            $table->dateTime('dropoff_at');

            $table->unsignedSmallInteger('days');

            /*
             |--------------------------------------------------------------------------
             | Driver Snapshot
             |--------------------------------------------------------------------------
             */

            $table->string('driver_first_name');
            $table->string('driver_last_name');

            $table->string('driver_email');
            $table->string('driver_phone');

            $table->date('driver_birth_date');

            $table->char('driver_country', 2);
            $table->string('driver_city');
            $table->string('driver_postal_code', 20);
            $table->string('driver_address_line_1');
            $table->string('driver_address_line_2')->nullable();

            $table->string('driver_licence_number');
            $table->char('driver_licence_country', 2);
            $table->date('driver_licence_issue_date');
            $table->date('driver_licence_expiry_date');

            /*
             |--------------------------------------------------------------------------
             | Pricing Snapshot
             |--------------------------------------------------------------------------
             */

            $table->char('currency', 3)->default('EUR');

            $table->decimal('daily_rate', 10, 2);

            $table->decimal('subtotal', 10, 2);
            $table->decimal('extras_total', 10, 2)->default(0);
            $table->foreignId('insurance_id')->nullable()->constrained()->nullOnDelete();
            $table->string('insurance_name')->nullable();
            $table->decimal('insurance_price', 10, 2)->nullable();
            $table->decimal('insurance_total', 10, 2)->default(0);

            $table->decimal('discount_total', 10, 2)->default(0);
            $table->decimal('tax_total', 10, 2)->default(0);

            $table->decimal('deposit_amount', 10, 2)->default(0);
            $table->decimal('total_amount', 10, 2);

            /*
             |--------------------------------------------------------------------------
             | Payment
             |--------------------------------------------------------------------------
             */

            $table->string('stripe_payment_intent_id')->nullable();
            $table->string('stripe_payment_method')->nullable();

            $table->string('payment_status')->default('pending');

            $table->timestamp('paid_at')->nullable();

            /*
             |--------------------------------------------------------------------------
             | Booking
             |--------------------------------------------------------------------------
             */

            $table->string('status')->default(BookingStatus::Pending->value);

            $table->text('notes')->nullable();

            $table->timestamp('confirmed_at')->nullable();
            $table->timestamp('cancelled_at')->nullable();
            $table->timestamp('completed_at')->nullable();

            $table->timestamps();

            $table->index('status');
            $table->index('payment_status');
            $table->index('pickup_at');
            $table->index('dropoff_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
