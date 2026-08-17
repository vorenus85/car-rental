<?php

namespace Database\Factories\Booking;

use App\Enums\BookingStatus;
use App\Enums\PaymentStatus;
use App\Models\Booking\Booking;
use App\Models\Booking\CarDriver;
use App\Models\Booking\Customer;
use App\Models\Fleet\Car;
use App\Models\Fleet\Location;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Booking>
 */
class BookingFactory extends Factory
{
    protected $model = Booking::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $pickupAt = fake()->dateTimeBetween('-90 days', '-1 day');
        $days = fake()->numberBetween(1, 14);
        $dropoffAt = (clone $pickupAt)->modify("+{$days} days");

        $dailyRate = fake()->randomFloat(2, 25, 200);
        $subtotal = round($dailyRate * $days, 2);
        $extrasTotal = fake()->randomFloat(2, 0, 150);
        $insuranceTotal = 0.0;
        $taxTotal = round(($subtotal + $extrasTotal + $insuranceTotal) * 0.21, 2);
        $totalAmount = round($subtotal + $extrasTotal + $insuranceTotal + $taxTotal, 2);

        $status = fake()->randomElement(BookingStatus::cases())->value;
        $paymentStatus = fake()->randomElement(PaymentStatus::cases())->value;
        $paymentMethod = fake()->randomElement(['stripe', 'paypal', 'cash']);
        $paidAt = in_array($paymentStatus, [PaymentStatus::Paid->value, PaymentStatus::PartiallyRefunded->value, PaymentStatus::Refunded->value], true)
            ? fake()->dateTimeBetween($pickupAt, 'now')
            : null;

        return [
            'booking_number' => sprintf('CR-%s-%s', now()->format('Ymd'), fake()->unique()->numerify('######')),
            'public_id' => 'BKG-'.implode('-', str_split(Str::upper(Str::random(16)), 4)),

            'customer_id' => Customer::factory(),
            'car_id' => Car::factory(),
            'driver_id' => CarDriver::factory(),

            'pickup_location_id' => Location::factory(),
            'dropoff_location_id' => Location::factory(),

            'pickup_at' => $pickupAt,
            'dropoff_at' => $dropoffAt,
            'days' => $days,

            'currency' => 'EUR',
            'daily_rate' => $dailyRate,
            'subtotal' => $subtotal,
            'extras_total' => $extrasTotal,
            'insurance_id' => null,
            'insurance_name' => null,
            'insurance_price' => null,
            'insurance_total' => $insuranceTotal,
            'tax_total' => $taxTotal,
            'total_amount' => $totalAmount,

            'payment_intent_id' => $paymentMethod === 'stripe' ? 'pi_'.Str::lower(Str::random(24)) : null,
            'payment_method' => $paymentMethod,
            'payment_status' => $paymentStatus,
            'paid_at' => $paidAt,

            'status' => $status,
            'notes' => fake()->optional()->paragraph(),

            'confirmed_at' => in_array($status, [BookingStatus::Confirmed->value, BookingStatus::PickedUp->value, BookingStatus::Returned->value], true)
                ? fake()->dateTimeBetween($pickupAt, 'now')
                : null,
            'cancelled_at' => $status === BookingStatus::Cancelled->value
                ? fake()->dateTimeBetween($pickupAt, 'now')
                : null,
            'completed_at' => $status === BookingStatus::Returned->value
                ? fake()->dateTimeBetween($pickupAt, 'now')
                : null,
        ];
    }
}
