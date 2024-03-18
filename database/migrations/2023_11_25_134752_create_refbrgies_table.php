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
        Schema::create('refbrgies', function (Blueprint $table) {
            $table->id();
            $table->string('brgyCode');
            $table->text('brgyDesc');
            $table->string('regCode');
            $table->string('provCode');
            $table->string('citymunCode');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('refbrgies');
    }
};
