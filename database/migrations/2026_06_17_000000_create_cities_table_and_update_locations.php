<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        foreach (['Budapest', 'Vienna', 'Prague'] as $city) {
            DB::table('cities')->updateOrInsert(
                ['name' => $city],
                ['created_at' => now(), 'updated_at' => now()]
            );
        }

        foreach (DB::table('locations')->distinct()->pluck('city') as $city) {
            DB::table('cities')->updateOrInsert(
                ['name' => $city],
                ['created_at' => now(), 'updated_at' => now()]
            );
        }

        Schema::table('locations', function (Blueprint $table) {
            $table->foreignId('city_id')
                ->nullable()
                ->after('country')
                ->constrained('cities')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
        });

        foreach (DB::table('cities')->pluck('id', 'name') as $name => $id) {
            DB::table('locations')
                ->where('city', $name)
                ->update(['city_id' => $id]);
        }

        Schema::table('locations', function (Blueprint $table) {
            $table->dropIndex(['city']);
            $table->dropColumn('city');
        });
    }

    public function down(): void
    {
        Schema::table('locations', function (Blueprint $table) {
            $table->string('city')->nullable()->after('country');
        });

        foreach (DB::table('cities')->pluck('name', 'id') as $id => $name) {
            DB::table('locations')
                ->where('city_id', $id)
                ->update(['city' => $name]);
        }

        Schema::table('locations', function (Blueprint $table) {
            $table->dropConstrainedForeignId('city_id');
            $table->index('city');
        });

        Schema::dropIfExists('cities');
    }
};
