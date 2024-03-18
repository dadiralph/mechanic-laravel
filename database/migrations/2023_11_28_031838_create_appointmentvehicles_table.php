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
        Schema::create('appointmentvehicles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('appointment_id')->constrained('appointments');
            $table->string('notes')->nullable();
            $table->string('make');
            $table->string('model');
            $table->string('problem_images');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointmentvehicles');
    }
};
