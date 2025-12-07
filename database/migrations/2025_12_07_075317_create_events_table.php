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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Sesuai seeder 'title'
            $table->text('description')->nullable(); // Sesuai seeder 'description'
            $table->dateTime('start_date'); // Sesuai seeder 'start_date'
            $table->dateTime('end_date');   // Sesuai seeder 'end_date'
            $table->string('status')->default('upcoming'); // Sesuai seeder 'status'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
