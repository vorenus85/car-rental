<?php

namespace Database\Seeders\Booking;

use App\Enums\BookingStatus;
use App\Enums\PaymentMethod;
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
            $this->command->warn(
                'Skipping bookings seeding because required booking data is missing.'
            );

            return;
        }


        $scenarios = [
            /*
            * HAPPY PATH
            */

            // Booking is pending because payment has not been completed yet and the rental period is in the future.

            [
                'name' => 'pending_payment',
                'booking_status' => BookingStatus::Pending->value,
                'payment_status' => PaymentStatus::Pending->value,
                'payment_method' => [PaymentMethod::Stripe->value, PaymentMethod::PayPal->value, PaymentMethod::Cash->value],
                'period' => 'future',
                'count' => 20,
            ],
            [
                'name' => 'confirmed_paid',
                'booking_status' => BookingStatus::Confirmed->value,
                'payment_status' => PaymentStatus::Paid->value,
                'payment_method' => [PaymentMethod::Stripe->value, PaymentMethod::PayPal->value, PaymentMethod::Cash->value],
                'period' => 'future',
                'count' => 30,
            ],
            [
                'name' => 'active_rental',
                'booking_status' => BookingStatus::PickedUp->value,
                'payment_status' => PaymentStatus::Paid->value,
                'payment_method' => [PaymentMethod::Stripe->value, PaymentMethod::PayPal->value, PaymentMethod::Cash->value],
                'period' => 'active',
                'count' => 20,
            ],
            [
                'name' => 'completed_rental',
                'booking_status' => BookingStatus::Returned->value,
                'payment_status' => PaymentStatus::Paid->value,
                'payment_method' => [PaymentMethod::Stripe->value, PaymentMethod::PayPal->value, PaymentMethod::Cash->value],
                'period' => 'past',
                'count' => 300,
            ],

            /*
            * PAYMENT EXCEPTIONS
            */

            [
                'name' => 'payment_failed',
                'booking_status' => BookingStatus::Pending->value,
                'payment_status' => PaymentStatus::Failed->value,
                'payment_method' => [PaymentMethod::Stripe->value, PaymentMethod::PayPal->value, PaymentMethod::Cash->value],
                'period' => 'past',
                'count' => 30,
            ],
            [
                'name' => 'payment_failed',
                'booking_status' => BookingStatus::Pending->value,
                'payment_status' => PaymentStatus::Failed->value,
                'payment_method' => [PaymentMethod::Stripe->value, PaymentMethod::PayPal->value, PaymentMethod::Cash->value],
                'period' => 'future',
                'count' => 10,
            ],
            [
                'name' => 'payment_cancelled',
                'booking_status' => BookingStatus::Pending->value,
                'payment_status' => PaymentStatus::Cancelled->value,
                'payment_method' => [PaymentMethod::Stripe->value, PaymentMethod::PayPal->value, PaymentMethod::Cash->value],
                'period' => 'past',
                'count' => 20,
            ],
            [
                'name' => 'payment_cancelled',
                'booking_status' => BookingStatus::Pending->value,
                'payment_status' => PaymentStatus::Cancelled->value,
                'payment_method' => [PaymentMethod::Stripe->value, PaymentMethod::PayPal->value, PaymentMethod::Cash->value],
                'period' => 'future',
                'count' => 10,
            ],


            /*
            * CANCELLATION / REFUND
            */

            [
                'name' => 'cancelled_unpaid',
                'booking_status' => BookingStatus::Cancelled->value,
                'payment_status' => PaymentStatus::Cancelled->value,
                'payment_method' => [PaymentMethod::Stripe->value, PaymentMethod::PayPal->value, PaymentMethod::Cash->value],
                'period' => 'past',
                'count' => 30,
            ],
            [
                'name' => 'cancelled_refunded',
                'booking_status' => BookingStatus::Cancelled->value,
                'payment_status' => PaymentStatus::Refunded->value,
                'payment_method' => [PaymentMethod::Stripe->value, PaymentMethod::PayPal->value, PaymentMethod::Cash->value],
                'period' => 'past',
                'count' => 30,
            ],
            [
                'name' => 'cancelled_partially_refunded',
                'booking_status' => BookingStatus::Cancelled->value,
                'payment_status' => PaymentStatus::PartiallyRefunded->value,
                'payment_method' => [PaymentMethod::Stripe->value, PaymentMethod::PayPal->value, PaymentMethod::Cash->value],
                'period' => 'past',
                'count' => 20,
            ],

            /*
            * COMPLETED RENTAL + REFUNDS
*/


            [
                'name' => 'completed_partially_refunded',
                'booking_status' => BookingStatus::Returned->value,
                'payment_status' => PaymentStatus::PartiallyRefunded->value,
                'payment_method' => [PaymentMethod::Stripe->value, PaymentMethod::PayPal->value, PaymentMethod::Cash->value],
                'period' => 'past',
                'count' => 30,
            ],

            [
                'name' => 'completed_refunded',
                'booking_status' => BookingStatus::Returned->value,
                'payment_status' => PaymentStatus::Refunded->value,
                'payment_method' => [PaymentMethod::Stripe->value, PaymentMethod::PayPal->value, PaymentMethod::Cash->value],
                'period' => 'past',
                'count' => 10,
            ],

            /*
            * OPERATIONAL / DASHBOARD SCENARIOS
            */


            [
                'name' => 'overdue_rental',
                'booking_status' => BookingStatus::PickedUp->value,
                'payment_status' => PaymentStatus::Paid->value,
                'payment_method' => [PaymentMethod::Stripe->value, PaymentMethod::PayPal->value, PaymentMethod::Cash->value],
                'period' => 'overdue',
                'count' => 30,
            ],


            [
                'name' => 'pickup_today',
                'booking_status' => BookingStatus::Confirmed->value,
                'payment_status' => PaymentStatus::Paid->value,
                'payment_method' => [PaymentMethod::Stripe->value, PaymentMethod::PayPal->value, PaymentMethod::Cash->value],
                'period' => 'pickup_today',
                'count' => 10,
            ],

            [
                'name' => 'dropoff_today',
                'booking_status' => BookingStatus::PickedUp->value,
                'payment_status' => PaymentStatus::Paid->value,
                'payment_method' => [PaymentMethod::Stripe->value, PaymentMethod::PayPal->value, PaymentMethod::Cash->value],
                'period' => 'dropoff_today',
                'count' => 10,
            ],

        ];



        $index = 1;

        foreach ($scenarios as $scenario) {
            for ($i = 0; $i < $scenario['count']; $i++) {
                $this->createScenarioBooking(
                    index: $index++,
                    scenario: $scenario,
                    customers: $customers,
                    cars: $cars,
                    locations: $locations,
                    drivers: $drivers,
                    insurances: $insurances,
                    extras: $extras,
                );
            }
        }

        $reassignedBookings = $this->repairBookingOverlaps();

        $this->command->info(
            "Bookings data seeded successfully! {$reassignedBookings} overlapping bookings reassigned."
        );
    }

    /**
     * Create a booking from a business scenario.
     */
    private function createScenarioBooking(
        int $index,
        array $scenario,
        $customers,
        $cars,
        $locations,
        $drivers,
        $insurances,
        $extras,
    ): void {
        [$pickupAt, $dropoffAt, $createdAt] = $this->generateDates(
            $scenario['period']
        );

        $this->createBooking(
            index: $index,
            pickupAt: $pickupAt,
            dropoffAt: $dropoffAt,
            createdAt: $createdAt,
            customers: $customers,
            cars: $cars,
            locations: $locations,
            drivers: $drivers,
            insurances: $insurances,
            extras: $extras,
            scenario: $scenario,
        );
    }

    /**
     * Generate dates according to the rental scenario.
     *
     * @return array{
     *     0: \DateTimeInterface,
     *     1: \DateTimeInterface,
     *     2: \DateTimeInterface
     * }
     */
    private function generateDates(string $period): array
    {
        $days = fake()->numberBetween(1, 14);

        switch ($period) {
            case 'overdue':
                // Overdue rental: the rental has started and the expected
                // drop-off time has already passed.
                $dropoffAt = $this->randomBusinessHoursDateBetween(
                    now()->subDays(14),
                    now()->subDay()
                );

                $pickupAt = $this->randomBusinessHoursDateBetween(
                    (clone $dropoffAt)->modify('-14 days'),
                    (clone $dropoffAt)->modify('-1 day')
                );

                $createdAt = $this->randomBusinessHoursDateBetween(
                    (clone $pickupAt)->modify('-30 days'),
                    (clone $pickupAt)->modify('-1 day')
                );

                break;

            case 'past':
                $pickupAt = $this->randomBusinessHoursDateBetween(
                    now()->subMonths(6),
                    now()->subDays(15)
                );

                $dropoffAt = (clone $pickupAt)->modify("+{$days} days");

                $createdAt = $this->randomBusinessHoursDateBetween(
                    (clone $pickupAt)->modify('-30 days'),
                    (clone $pickupAt)->modify('-1 day')
                );

                break;

            case 'active':
                $pickupAt = $this->randomBusinessHoursDateBetween(
                    now()->subDays(7),
                    now()->subDay()
                );

                $dropoffAt = now()->addDays(
                    fake()->numberBetween(1, 7)
                );

                $createdAt = $this->randomBusinessHoursDateBetween(
                    (clone $pickupAt)->modify('-30 days'),
                    (clone $pickupAt)->modify('-1 day')
                );

                break;

            case 'future':
                $pickupAt = $this->randomBusinessHoursDateBetween(
                    now()->addDay(),
                    now()->addMonthsNoOverflow(2)
                );

                $dropoffAt = (clone $pickupAt)->modify("+{$days} days");

                $createdAt = $this->randomBusinessHoursDateBetween(
                    now()->subMonths(3),
                    now()->subDay()
                );

                break;

            case 'pickup_today':
                // Pickup is scheduled for today.
                // The rental has not started yet and the drop-off is in the future.
                $pickupAt = $this->randomBusinessHoursDateBetween(
                    now()->startOfDay(),
                    now()
                );

                $dropoffAt = (clone $pickupAt)->modify(
                    '+' . fake()->numberBetween(1, 14) . ' days'
                );

                $createdAt = $this->randomBusinessHoursDateBetween(
                    now()->subMonths(3),
                    now()->subDay()
                );

                break;

            case 'dropoff_today':
                // Drop-off is scheduled for today.
                // The rental has already started and is still active.
                $pickupAt = $this->randomBusinessHoursDateBetween(
                    now()->subDays(14),
                    now()->subDay()
                );

                $dropoffAt = now()->addHours(
                    fake()->numberBetween(1, 6)
                );

                $createdAt = $this->randomBusinessHoursDateBetween(
                    (clone $pickupAt)->modify('-30 days'),
                    (clone $pickupAt)->modify('-1 day')
                );

                break;

            default:
                throw new \InvalidArgumentException(
                    "Unknown booking period: {$period}"
                );
        }

        return [
            $pickupAt,
            $dropoffAt,
            $createdAt,
        ];
    }

    /**
     * @param  array<string, mixed>  $scenario
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
        array $scenario,
    ): void {
        $days = max(1, $pickupAt->diff($dropoffAt)->days);

        $car = Car::query()->findOrFail($cars->random());
        $insurance = $insurances->random();

        $pickupLocationId = $locations->random();

        $dropoffLocationId = fake()->boolean(35) && $locations->count() > 1
            ? $locations
            ->reject(fn($locationId) => $locationId === $pickupLocationId)
            ->random()
            : $pickupLocationId;

        $extraCount = $extras->isEmpty()
            ? 0
            : fake()->numberBetween(0, min(3, $extras->count()));

        $selectedExtras = $extraCount === 0
            ? collect()
            : collect($extras->random($extraCount))->values();

        $extraSnapshots = $selectedExtras->map(
            function (Extra $extra) use ($days) {
                $quantity = fake()->numberBetween(1, 3);

                return [
                    'extra' => $extra,
                    'quantity' => $quantity,
                    'total_price' => round(
                        $quantity * $days * (float) $extra->price,
                        2
                    ),
                ];
            }
        );

        $dailyRate = (float) $car->price_per_day;

        $subtotal = round(
            $dailyRate * $days,
            2
        );

        $insuranceTotal = round(
            $days * (float) $insurance->price,
            2
        );

        $extrasTotal = round(
            $extraSnapshots->sum('total_price'),
            2
        );

        $taxTotal = round(
            ($subtotal + $insuranceTotal + $extrasTotal) * 0.21,
            2
        );

        $totalAmount = round(
            $subtotal
                + $insuranceTotal
                + $extrasTotal
                + $taxTotal,
            2
        );

        /*
         * The scenario is the single source of truth
         * for booking/payment state.
         */
        $status = $scenario['booking_status'];
        $paymentStatus = $scenario['payment_status'];
        $paymentMethod = $scenario['payment_method'][array_rand($scenario['payment_method'])];

        $paidAt = in_array(
            $paymentStatus,
            [
                PaymentStatus::Paid->value,
                PaymentStatus::PartiallyRefunded->value,
                PaymentStatus::Refunded->value,
            ],
            true
        )
            ? fake()->dateTimeBetween($createdAt, $pickupAt)
            : null;


        $booking = Booking::factory()->create([
            'booking_number' => sprintf(
                'CR-%s-%04d',
                $createdAt->format('Ymd'),
                $index
            ),

            'public_id' => 'BKG-' . implode(
                '-',
                str_split(Str::upper(Str::random(16)), 4)
            ),

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

            'payment_intent_id' => $paymentMethod === PaymentMethod::Stripe->value
                ? 'pi_' . Str::lower(Str::random(24))
                : null,

            'payment_method' => $paymentMethod,
            'payment_status' => $paymentStatus,
            'paid_at' => $paidAt,

            'status' => $status,

            'notes' => fake()->optional()->paragraph(),

            'confirmed_at' => $this->makeConfirmedAt(
                status: $status,
                createdAt: $createdAt,
                pickupAt: $pickupAt,
            ),

            'cancelled_at' => $this->makeCancelledAt(
                status: $status,
                createdAt: $createdAt,
                pickupAt: $pickupAt,
            ),

            'completed_at' => $status === BookingStatus::Returned->value
                ? fake()->dateTimeBetween($pickupAt, $dropoffAt)
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
    ): ?\DateTimeInterface {
        if (! in_array(
            $status,
            [
                BookingStatus::Confirmed->value,
                BookingStatus::PickedUp->value,
                BookingStatus::Returned->value,
            ],
            true
        )) {
            return null;
        }

        return fake()->dateTimeBetween(
            $createdAt,
            $pickupAt
        );
    }

    private function makeCancelledAt(
        string $status,
        \DateTimeInterface $createdAt,
        \DateTimeInterface $pickupAt,
    ): ?\DateTimeInterface {
        if (!in_array(
            $status,
            [
                BookingStatus::Cancelled->value,
            ],
            true
        )) {
            return null;
        }

        return fake()->dateTimeBetween(
            $createdAt,
            $pickupAt
        );
    }

    private function randomBusinessHoursDateBetween(
        \DateTimeInterface $startDate,
        \DateTimeInterface $endDate
    ): \DateTimeInterface {
        $dateTime = fake()->dateTimeBetween(
            $startDate,
            $endDate
        );

        return $this->normalizeToBusinessHoursHalfHour(
            $dateTime
        );
    }

    private function normalizeToBusinessHoursHalfHour(
        \DateTimeInterface $dateTime
    ): \DateTimeInterface {
        $hour = fake()->numberBetween(10, 20);
        $minute = $hour === 20
            ? 0
            : fake()->randomElement([0, 30]);

        if ($dateTime instanceof \DateTimeImmutable) {
            return $dateTime->setTime(
                $hour,
                $minute,
                0
            );
        }

        $normalized = clone $dateTime;

        $normalized->setTime(
            $hour,
            $minute,
            0
        );

        return $normalized;
    }

    private function repairBookingOverlaps(): int
    {
        $carIds = Car::query()->pluck('id');

        $occupiedByCar = $carIds
            ->mapWithKeys(fn($carId) => [$carId => []])
            ->all();

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
                fn($carId) => (int) $carId === (int) $booking->car_id
                    ? 0
                    : 1
            );

            $availableCarId = $candidateCarIds->first(
                function ($carId) use (
                    $booking,
                    $occupiedByCar
                ) {
                    foreach ($occupiedByCar[$carId] as $reservation) {
                        $overlaps =
                            $booking->pickup_at->lt(
                                $reservation['dropoff_at']
                            )
                            && $booking->dropoff_at->gt(
                                $reservation['pickup_at']
                            );

                        if ($overlaps) {
                            return false;
                        }
                    }

                    return true;
                }
            );

            if ($availableCarId === null) {
                throw new \RuntimeException(
                    "Unable to repair booking overlap for booking {$booking->id}: no car is available."
                );
            }

            if (
                (int) $booking->car_id !== (int) $availableCarId
            ) {
                $booking->updateQuietly([
                    'car_id' => $availableCarId,
                ]);

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
