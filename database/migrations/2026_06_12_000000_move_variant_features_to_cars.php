<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (! Schema::hasTable('car_feature')) {
            Schema::create('car_feature', function (Blueprint $table) {
                $table->id();

                $table->foreignId('car_id')
                    ->constrained()
                    ->cascadeOnDelete();

                $table->foreignId('feature_id')
                    ->constrained()
                    ->cascadeOnDelete();

                $table->unique(['car_id', 'feature_id']);
            });
        }

        if (Schema::hasTable('feature_variant')) {
            DB::table('cars')
                ->join('feature_variant', 'cars.variant_id', '=', 'feature_variant.variant_id')
                ->select('cars.id as car_id', 'feature_variant.feature_id')
                ->orderBy('cars.id')
                ->chunk(500, function ($rows) {
                    DB::table('car_feature')->insertOrIgnore(
                        $rows->map(fn ($row) => [
                            'car_id' => $row->car_id,
                            'feature_id' => $row->feature_id,
                        ])->all()
                    );
                });

            Schema::dropIfExists('feature_variant');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (! Schema::hasTable('feature_variant')) {
            Schema::create('feature_variant', function (Blueprint $table) {
                $table->id();

                $table->foreignId('variant_id')
                    ->constrained()
                    ->cascadeOnDelete();

                $table->foreignId('feature_id')
                    ->constrained()
                    ->cascadeOnDelete();

                $table->unique(['variant_id', 'feature_id']);
            });
        }

        if (Schema::hasTable('car_feature')) {
            DB::table('cars')
                ->join('car_feature', 'cars.id', '=', 'car_feature.car_id')
                ->select('cars.variant_id', 'car_feature.feature_id')
                ->distinct()
                ->orderBy('cars.variant_id')
                ->chunk(500, function ($rows) {
                    DB::table('feature_variant')->insertOrIgnore(
                        $rows->map(fn ($row) => [
                            'variant_id' => $row->variant_id,
                            'feature_id' => $row->feature_id,
                        ])->all()
                    );
                });

            Schema::dropIfExists('car_feature');
        }
    }
};
