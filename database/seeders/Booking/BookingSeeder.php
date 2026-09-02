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

        $bookingStatuses = array_map(fn(BookingStatus $status) => $status->value, BookingStatus::cases());
        $paymentStatuses = array_map(fn(PaymentStatus $status) => $status->value, PaymentStatus::cases());
        $paymentMethods = ['stripe', 'paypal', 'cash'];

        $pastBookingCount = 250;
        $futureBookingCount = 150;

        $pastPickupStart = now()->subMonths(6);
        $pastPickupEnd = now()->subDays(15);
        $futurePickupStart = now()->addDay();
        $futurePickupEnd = now()->addMonthsNoOverflow(2)->subDays(14);

        for ($i = 1; $i <= $pastBookingCount; $i++) {
            $pickupAt = $this->randomBusinessHoursDateBetween($pastPickupStart, $pastPickupEnd);
            $days = fake()->numberBetween(1, 14);
            $dropoffAt = (clone $pickupAt)->modify("+{$days} days");
            $createdAt = $this->randomBusinessHoursDateBetween(
                (clone $pickupAt)->modify('-30 days'),
                (clone $pickupAt)->modify('-1 day')
            );

            $this->createBooking(
                index: $i,
                pickupAt: $pickupAt,
                dropoffAt: $dropoffAt,
                createdAt: $createdAt,
                customers: $customers,
                cars: $cars,
                locations: $locations,
                drivers: $drivers,
                insurances: $insurances,
                extras: $extras,
                bookingStatuses: $bookingStatuses,
                paymentStatuses: $paymentStatuses,
                paymentMethods: $paymentMethods,
                futureBooking: false
            );
        }

        for ($i = 1; $i <= $futureBookingCount; $i++) {
            $pickupAt = $this->randomBusinessHoursDateBetween($futurePickupStart, $futurePickupEnd);
            $days = fake()->numberBetween(1, 14);
            $dropoffAt = (clone $pickupAt)->modify("+{$days} days");
            $createdAt = $this->randomBusinessHoursDateBetween(
                now()->subMonths(3),
                now()->subDay()
            );

            $this->createBooking(
                index: $pastBookingCount + $i,
                pickupAt: $pickupAt,
                dropoffAt: $dropoffAt,
                createdAt: $createdAt,
                customers: $customers,
                cars: $cars,
                locations: $locations,
                drivers: $drivers,
                insurances: $insurances,
                extras: $extras,
                bookingStatuses: $bookingStatuses,
                paymentStatuses: $paymentStatuses,
                paymentMethods: $paymentMethods,
                futureBooking: true
            );
        }

        $todayPickupCount = fake()->numberBetween(2, 3);
        for ($i = 1; $i <= $todayPickupCount; $i++) {
            $pickupAt = $this->randomBusinessHoursDateBetween(
                now()->startOfDay(),
                now()->endOfDay()
            );
            $createdAt = $this->randomBusinessHoursDateBetween(
                now()->subMonths(3),
                (clone $pickupAt)->modify('-1 day')
            );

            $this->createBooking(
                index: $pastBookingCount + $futureBookingCount + $i,
                pickupAt: $pickupAt,
                dropoffAt: (clone $pickupAt)->modify('+' . fake()->numberBetween(1, 14) . ' days'),
                createdAt: $createdAt,
                customers: $customers,
                cars: $cars,
                locations: $locations,
                drivers: $drivers,
                insurances: $insurances,
                extras: $extras,
                bookingStatuses: $bookingStatuses,
                paymentStatuses: $paymentStatuses,
                paymentMethods: $paymentMethods,
                futureBooking: true,
                forcedStatus: BookingStatus::Confirmed->value
            );
        }

        $todayDropoffCount = fake()->numberBetween(2, 3);
        for ($i = 1; $i <= $todayDropoffCount; $i++) {
            $dropoffAt = $this->randomBusinessHoursDateBetween(
                now()->startOfDay(),
                now()->endOfDay()
            );
            $pickupAt = (clone $dropoffAt)->modify('-' . fake()->numberBetween(1, 14) . ' days');
            $createdAt = $this->randomBusinessHoursDateBetween(
                now()->subMonths(3),
                (clone $pickupAt)->modify('-1 day')
            );

            $this->createBooking(
                index: $pastBookingCount + $futureBookingCount + $todayPickupCount + $i,
                pickupAt: $pickupAt,
                dropoffAt: $dropoffAt,
                createdAt: $createdAt,
                customers: $customers,
                cars: $cars,
                locations: $locations,
                drivers: $drivers,
                insurances: $insurances,
                extras: $extras,
                bookingStatuses: $bookingStatuses,
                paymentStatuses: $paymentStatuses,
                paymentMethods: $paymentMethods,
                futureBooking: false,
                forcedStatus: fake()->randomElement([
                    BookingStatus::Confirmed->value,
                    BookingStatus::PickedUp->value,
                ])
            );
        }

        $reassignedBookings = $this->repairBookingOverlaps();

        $this->command->info(
            "Bookings data seeded successfully! {$reassignedBookings} overlapping bookings reassigned."
        );
    }

    /**
     * @param  array<int, string>  $bookingStatuses
     * @param  array<int, string>  $paymentStatuses
     * @param  array<int, string>  $paymentMethods
     */
    private function createBooking(
        int $index,
        \DateTimeInterface $pickupAt,
        \DateTimeInterface $dropoffAt,
        \DateTimeInterface $createdAt,
        $customers,
        $cars,
        $locations,
        $drivers,
        $insurances,
        $extras,
        array $bookingStatuses,
        array $paymentStatuses,
        array $paymentMethods,
        bool $futureBooking,
        ?string $forcedStatus = null,
    ): void {
        $days = max(1, $pickupAt->diff($dropoffAt)->days);

        $car = Car::query()->findOrFail($cars->random());
        $insurance = $insurances->random();
        $pickupLocationId = $locations->random();
        $dropoffLocationId = fake()->boolean(35) && $locations->count() > 1
            ? $locations->reject(fn($locationId) => $locationId === $pickupLocationId)->random()
            : $pickupLocationId;

        $extraCount = $extras->isEmpty() ? 0 : fake()->numberBetween(0, min(3, $extras->count()));

        $selectedExtras = $extraCount === 0
            ? collect()
            : collect($extras->random($extraCount))->values();

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

        $status = $forcedStatus ?? ($futureBooking
            ? fake()->randomElement([
                BookingStatus::Pending->value,
                BookingStatus::Confirmed->value,
                BookingStatus::Cancelled->value,
            ])
            : fake()->randomElement($bookingStatuses));

        $paymentStatus = fake()->randomElement($paymentStatuses);
        $paymentMethod = fake()->randomElement($paymentMethods);

        $paidAt = in_array($paymentStatus, [
            PaymentStatus::Paid->value,
            PaymentStatus::PartiallyRefunded->value,
            PaymentStatus::Refunded->value,
        ], true)
            ? fake()->dateTimeBetween($createdAt, 'now')
            : null;

        $booking = Booking::factory()->create([
            'booking_number' => sprintf('CR-%s-%04d', $createdAt->format('Ymd'), $index),
            'public_id' => 'BKG-' . implode('-', str_split(Str::upper(Str::random(16)), 4)),

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

            'payment_intent_id' => $paymentMethod === 'stripe' ? 'pi_' . Str::lower(Str::random(24)) : null,
            'payment_method' => $paymentMethod,
            'payment_status' => $paymentStatus,
            'paid_at' => $paidAt,

            'status' => $status,
            'notes' => fake()->optional()->paragraph(),

            'confirmed_at' => $this->makeConfirmedAt($status, $createdAt, $pickupAt, $futureBooking),
            'cancelled_at' => $this->makeCancelledAt($status, $createdAt, $pickupAt, $futureBooking),
            'completed_at' => $status === BookingStatus::Returned->value && ! $futureBooking
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

    private function makeConfirmedAt(
        string $status,
        \DateTimeInterface $createdAt,
        \DateTimeInterface $pickupAt,
        bool $futureBooking,
    ): ?\DateTimeInterface {
        if (! in_array($status, [
            BookingStatus::Confirmed->value,
            BookingStatus::PickedUp->value,
            BookingStatus::Returned->value,
        ], true)) {
            return null;
        }

        $endDate = $futureBooking ? $pickupAt : now();

        return fake()->dateTimeBetween($createdAt, $endDate);
    }

    private function makeCancelledAt(
        string $status,
        \DateTimeInterface $createdAt,
        \DateTimeInterface $pickupAt,
        bool $futureBooking,
    ): ?\DateTimeInterface {
        if ($status !== BookingStatus::Cancelled->value) {
            return null;
        }

        $endDate = $futureBooking ? now() : $pickupAt;

        return fake()->dateTimeBetween($createdAt, $endDate);
    }

    private function randomBusinessHoursDateBetween(\DateTimeInterface $startDate, \DateTimeInterface $endDate): \DateTimeInterface
    {
        $dateTime = fake()->dateTimeBetween($startDate, $endDate);

        return $this->normalizeToBusinessHoursHalfHour($dateTime);
    }

    private function normalizeToBusinessHoursHalfHour(\DateTimeInterface $dateTime): \DateTimeInterface
    {
        $hour = fake()->numberBetween(10, 20);
        $minute = $hour === 20 ? 0 : fake()->randomElement([0, 30]);

        if ($dateTime instanceof \DateTimeImmutable) {
            return $dateTime->setTime($hour, $minute, 0);
        }

        $normalized = clone $dateTime;
        $normalized->setTime($hour, $minute, 0);

        return $normalized;
    }

    private function repairBookingOverlaps(): int
    {
        $carIds = Car::query()->pluck('id');
        $occupiedByCar = $carIds->mapWithKeys(fn($carId) => [$carId => []])->all();
        $reassignedBookings = 0;

        $bookings = Booking::query()
            ->orderBy('pickup_at')
            ->orderBy('id')
            ->get([
                'id',
                'car_id',
                'pickup_at',
                'dropoff_at',
            ]);

        foreach ($bookings as $booking) {
            $candidateCarIds = $carIds->sortBy(
                fn($carId) => (int) $carId === (int) $booking->car_id ? 0 : 1
            );
            $availableCarId = $candidateCarIds->first(function ($carId) use ($booking, $occupiedByCar) {
                foreach ($occupiedByCar[$carId] as $reservation) {
                    $overlaps = $booking->pickup_at->lt($reservation['dropoff_at'])
                        && $booking->dropoff_at->gt($reservation['pickup_at']);

                    if ($overlaps) {
                        return false;
                    }
                }

                return true;
            });

            if ($availableCarId === null) {
                throw new \RuntimeException(
                    "Unable to repair booking overlap for booking {$booking->id}: no car is available."
                );
            }

            if ((int) $booking->car_id !== (int) $availableCarId) {
                $booking->updateQuietly(['car_id' => $availableCarId]);
                $reassignedBookings++;
            }

            $occupiedByCar[$availableCarId][] = [
                'pickup_at' => $booking->pickup_at,
                'dropoff_at' => $booking->dropoff_at,
            ];
        }

        return $reassignedBookings;
    }
}
