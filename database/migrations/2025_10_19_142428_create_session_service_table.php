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
        Schema::create('session_service', function (Blueprint $table) {
            $table->id();
            $table->foreignId('session_therapy_id')->constrained('sessions_therapy')->cascadeOnDelete();
            $table->foreignId('medical_service_id')->constrained('medical_services')->cascadeOnDelete();
            $table->timestamps();

            // Índice único para evitar duplicados
            $table->unique(['session_therapy_id', 'medical_service_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('session_service');
    }
};