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
        Schema::create('users', function (Blueprint $table) {
            $table->string('username', 50)->primary();
            $table->text('password');
            $table->timestamps();
        });
        
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary(); // ID sesi unik
            $table->string('user_id')->nullable()->index(); // Kolom user_id sebagai VARCHAR
            $table->foreign('user_id')->references('username')->on('users'); // Foreign key ke kolom username
            $table->string('ip_address', 45)->nullable(); // Menyimpan IP pengguna
            $table->text('user_agent')->nullable(); // Menyimpan data User-Agent
            $table->longText('payload'); // Data sesi tersimpan
            $table->integer('last_activity')->index(); // Waktu aktivitas terakhir
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
