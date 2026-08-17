<?php

namespace Database\Seeders\Booking;

use App\Enums\BookingStatus;
use App\Enums\PaymentStatus;
use App\Models\Booking\Booking;
use App\Models\Booking\BookingExtra;
use App\Models\Booking\CarDriver;
use App\Models\Booking\Customer;
use App\Models\Booking\Extra;
use App\Models\Booking\Insurance;
use App\Models\Fleet\Car;
use App\Models\Fleet\Location;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = Customer::query()->pluck('id');
        $cars = Car::query()->pluck('id');
        $locations = Location::query()->pluck('id');
        $drivers = CarDriver::query()->pluck('id');
        $insurances = Insurance::query()->get();
        $extras = Extra::query()->get();

        if (
            $customers->isEmpty()
            || $cars->isEmpty()
            || $locations->isEmpty()
            || $drivers->isEmpty()
            || $insurances->isEmpty()
        ) {
            $this->command->warn('Skipping bookings seeding because required booking data is missing.');

            return;
        }

        $bookingStatuses = array_map(fn (BookingStatus $status) => $status->value, BookingStatus::cases());
        $paymentStatuses = array_map(fn (PaymentStatus $status) => $status->value, PaymentStatus::cases());
        $paymentMethods = ['stripe', 'paypal', 'cash'];

        $totalIterations = 100;

        for ($i = 1; $i <= $totalIterations; $i++) {
            $startDate = now()->subMonths(3);
            $endDate = now()->subDay();

            $progress = ($i - 1) / ($totalIterations - 1);

            $pickupAt = $startDate->copy()->addSeconds(
                $startDate->diffInSeconds($endDate) * $progress
            );

            $days = fake()->numberBetween(1, 14);
            $dropoffAt = (clone $pickupAt)->modify("+{$days} days");
            $createdAt = (clone $pickupAt)->modify('-7 days');

            $car = Car::query()->findOrFail($cars->random());
            $insurance = $insurances->random();
            $pickupLocationId = $locations->random();
            $dropoffLocationId = fake()->boolean(35) && $locations->count() > 1
                ? $locations->reject(fn ($locationId) => $locationId === $pickupLocationId)->random()
                : $pickupLocationId;

            $extraCount = $extras->isEmpty() ? 0 : fake()->numberBetween(0, min(3, $extras->count()));

            $selectedExtras = $extraCount === 0
                ? collect()
                : $extras->random($extraCount);

            $selectedExtras = collect($selectedExtras)->values();
            $extraSnapshots = $selectedExtras->map(function (Extra $extra) use ($days) {
                $quantity = fake()->numberBetween(1, 3);

                return [
                    'extra' => $extra,
                    'quantity' => $quantity,
                    'total_price' => round($quantity * $days * (float) $extra->price, 2),
                ];
            });

            $dailyRate = (float) $car->price_per_day;
            $subtotal = round($dailyRate * $days, 2);
            $insuranceTotal = round($days * (float) $insurance->price, 2);
            $extrasTotal = round($extraSnapshots->sum('total_price'), 2);

            $taxTotal = round(($subtotal + $insuranceTotal + $extrasTotal) * 0.21, 2);
            $totalAmount = round($subtotal + $insuranceTotal + $extrasTotal + $taxTotal, 2);

            $status = fake()->randomElement($bookingStatuses);
            $paymentStatus = fake()->randomElement($paymentStatuses);
            $paymentMethod = fake()->randomElement($paymentMethods);
            $paidAt = in_array($paymentStatus, [PaymentStatus::Paid->value, PaymentStatus::PartiallyRefunded->value, PaymentStatus::Refunded->value], true)
                ? fake()->dateTimeBetween($pickupAt, 'now')
                : null;

            $booking = Booking::factory()->create([
                'booking_number' => sprintf('CR-%s-%04d', $createdAt->format('Ymd'), $i + 1),
                'public_id' => 'BKG-'.implode('-', str_split(Str::upper(Str::random(16)), 4)),

                'customer_id' => $customers->random(),
                'car_id' => $car->id,
                'driver_id' => $drivers->random(),

                'pickup_location_id' => $pickupLocationId,
                'dropoff_location_id' => $dropoffLocationId,

                'pickup_at' => $pickupAt,
                'dropoff_at' => $dropoffAt,
                'days' => $days,

                'currency' => 'EUR',
                'daily_rate' => $dailyRate,
                'subtotal' => $subtotal,
                'extras_total' => $extrasTotal,
                'insurance_id' => $insurance->id,
                'insurance_name' => $insurance->name,
                'insurance_price' => $insurance->price,
                'insurance_total' => $insuranceTotal,
                'tax_total' => $taxTotal,
                'total_amount' => $totalAmount,

                'payment_intent_id' => $paymentMethod === 'stripe' ? 'pi_'.Str::lower(Str::random(24)) : null,
                'payment_method' => $paymentMethod,
                'payment_status' => $paymentStatus,
                'paid_at' => $paidAt,

                'status' => $status,
                'notes' => fake()->optional()->paragraph(),

                'confirmed_at' => in_array($status, [
                    BookingStatus::Confirmed->value,
                    BookingStatus::PickedUp->value,
                    BookingStatus::Returned->value,
                ], true)
                    ? fake()->dateTimeBetween($pickupAt, 'now')
                    : null,
                'cancelled_at' => $status === BookingStatus::Cancelled->value
                    ? fake()->dateTimeBetween($pickupAt, 'now')
                    : null,
                'completed_at' => $status === BookingStatus::Returned->value
                    ? fake()->dateTimeBetween($pickupAt, 'now')
                    : null,
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ]);

            DB::table('booking_insurance')->insert([
                'booking_id' => $booking->id,
                'insurance_id' => $insurance->id,
                'name' => $insurance->name,
                'price' => $insurance->price,
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ]);

            foreach ($extraSnapshots as $snapshot) {
                /** @var Extra $extra */
                $extra = $snapshot['extra'];

                BookingExtra::create([
                    'booking_id' => $booking->id,
                    'extra_id' => $extra->id,
                    'name' => $extra->name,
                    'quantity' => $snapshot['quantity'],
                    'unit_price' => $extra->price,
                    'total_price' => $snapshot['total_price'],
                ]);
            }
        }

        $this->command->info('Bookings data seeded successfully!');
    }
}
