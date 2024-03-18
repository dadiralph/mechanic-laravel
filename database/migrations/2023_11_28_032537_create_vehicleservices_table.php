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
        Schema::create('vehicleservices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('appointment_vehicle_id')->constrained('appointmentvehicles');
            $table->foreignId('service_id')->constrained('mechanicservices');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicleservices');
    }
};
