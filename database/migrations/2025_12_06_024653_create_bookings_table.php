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
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Siapa yg sewa

            // Polymorphic: Bisa ID PC atau ID Arena
            $table->unsignedBigInteger('bookable_id');
            $table->string('bookable_type');

            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->decimal('total_price', 12, 2);

            $table->enum('status', ['pending', 'confirmed', 'completed', 'cancelled', 'rejected'])->default('pending');
            $table->string('payment_method')->default('cash'); // cash, transfer
            $table->string('payment_proof')->nullable(); // Gambar bukti bayar

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
