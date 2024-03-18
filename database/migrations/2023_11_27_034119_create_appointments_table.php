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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('users');
            $table->foreignId('mechanic_id')->constrained('users');
            $table->date('date_start');
            $table->date('date_end')->nullable();
            $table->string('start_time');
            $table->string('end_time');
            $table->enum('status', ['Pending', 'In Progress', 'Completed', 'Rejected', 'No Response', 'Cancelled']);
            $table->enum('appointment_type', ['Home Service', 'Emergency Service']);
            $table->string('reason')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
