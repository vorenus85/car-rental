<?php

namespace App\Http\Services\Storefront;

use App\Models\Fleet\Car;
use Illuminate\Support\Collection;

class SimilarCarsService
{
    public function getSimilarCars(Car $car, int $limit = 8): Collection
    {
        return Car::query()
            ->where('id', '!=', $car->id)
            ->with(['variant', 'variant.model',])
            ->where('status', 'available')
            ->get()
            ->map(function (Car $candidate) use ($car) {
                $candidate->setAttribute(
                    'similarity_score',
                    $this->calculateScore($candidate, $car)
                );

                return $candidate;
            })
            ->sortByDesc('similarity_score')
            ->take($limit)
            ->values();
    }

    private function calculateScore(Car $candidate, Car $car): int
    {
        $score = 0;

        // Body type
        if ($candidate->variant->body_type === $car->variant->body_type) {
            $score += 50;
        }

        // Transmission
        if ($candidate->variant->transmission === $car->variant->transmission) {
            $score += 20;
        }

        // Fuel type
        if ($candidate->variant->fuel === $car->variant->fuel) {
            $score += 15;
        }

        // Seats
        if ($candidate->variant->seats === $car->variant->seats) {
            $score += 10;
        }

        // Luggage
        if ($candidate->variant->luggage_count === $car->variant->luggage_count) {
            $score += 5;
        }

        // Price similarity
        $priceDifference = abs(
            $candidate->price_per_day - $car->price_per_day
        );

        $score += max(0, 20 - $priceDifference);

        return $score;
    }
}
