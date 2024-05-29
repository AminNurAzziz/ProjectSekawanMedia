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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->string('VehicleID', 50)->primary();
            $table->string('VehicleModel', 100);
            $table->enum('VehicleType', ['Cargo', 'Passenger']);
            $table->enum('VehicleStatus', ['Available', 'Booked', 'On-Trip', 'Under-Maintenance']); // Tambahkan status 'Under-Maintenance
            $table->float('FuelConsumptionPerKM');
            $table->integer('ServiceIntervalKM');
            $table->float('LastBBM')->default(0);
            $table->float('LastKM')->default(0);
            $table->float('KM_Need_Service')->default(0);
            $table->enum('Ownership', ['Company', 'Rented']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
