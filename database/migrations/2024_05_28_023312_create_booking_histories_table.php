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
        Schema::create('booking_histories', function (Blueprint $table) {
            $table->id('HistoryID');
            $table->unsignedBigInteger('BookingID');
            $table->foreign('BookingID')->references('BookingID')->on('bookings');
            $table->date('ReturnDate');
            $table->integer('LastOdometerReading');
            $table->float('FuelUsed');
            $table->enum('BookingStatus', ['Completed', 'Cancelled']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_histories');
    }
};
