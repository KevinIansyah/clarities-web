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
        Schema::create('booking_labs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('room_lab_id')->constrained('room_labs')->onDelete('cascade');
            $table->string('name');
            $table->string('npm');
            $table->string('angkatan');
            $table->string('event');
            $table->integer('participant');
            $table->string('date_start');
            $table->string('date_end');
            $table->string('time_start');
            $table->string('time_end');
            $table->boolean('toga_hakim')->default(false);
            $table->boolean('toga_jaksa')->default(false);
            $table->boolean('toga_penasihat_hukum')->default(false);
            $table->boolean('baju_tahanan')->default(false);
            $table->boolean('baju_petugas_kepolisian')->default(false);
            $table->text('lainnya')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_labs');
    }
};
