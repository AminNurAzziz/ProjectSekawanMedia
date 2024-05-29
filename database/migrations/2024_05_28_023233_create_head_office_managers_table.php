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
        Schema::create('head_office_managers', function (Blueprint $table) {
            $table->id('HeadManagerID');
            $table->string('Name', 100);
            $table->foreignId('PositionID')->constrained('positions', 'PositionID');
            $table->string('PhoneNumber', 15);
            $table->unsignedBigInteger('UserID')->nullable();
            $table->foreign('UserID')->references('id')->on('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('head_office_managers');
    }
};
