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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id('BookingID');
            $table->string('BookerName', 100);
            $table->string('VehicleID', 50)->nullable();
            $table->foreign('VehicleID')->references('VehicleID')->on('vehicles')->onDelete('set null');
            $table->foreignId('DriverID')->nullable()->constrained('company_drivers', 'DriverID')->onDelete('set null');
            $table->date('BookingDate');
            $table->string('BookingStatus', 50)->enum(['Pending', 'Approved', 'Rejected'])->default('Pending');
            $table->string('BranchManagerApproval', 50)->enum(['Pending', 'Approved', 'Rejected'])->default('Pending');
            $table->string('HeadOfficeManagerApproval', 50)->enum(['Pending', 'Approved', 'Rejected'])->default('Pending');
            $table->unsignedBigInteger('BranchManagerID');
            $table->unsignedBigInteger('HeadOfficeManagerID');
            $table->foreign('BranchManagerID')->nullable()->references('ManagerID')->on('branch_managers')->onDelete('cascade');
            $table->foreign('HeadOfficeManagerID')->nullable()->references('HeadManagerID')->on('head_office_managers')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
