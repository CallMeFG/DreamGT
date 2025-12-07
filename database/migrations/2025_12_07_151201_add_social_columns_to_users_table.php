<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('google_id')->nullable()->unique();
            $table->string('github_id')->nullable()->unique();
            $table->string('avatar')->nullable(); // Foto profil dari sosmed
            $table->string('password')->nullable()->change(); // Password boleh kosong jika login sosmed
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['google_id', 'github_id', 'avatar']);
        });
    }
};
