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
        Schema::create('medical_records', function (Blueprint $table) {
            $table->id();
            $table->text('allergies')->nullable();
            $table->text('pathologies')->nullable();
            $table->text('medications')->nullable();
            $table->text('past_surgeries')->nullable();
            $table->text('notes_general')->nullable();
            $table->foreignId('patient_id')->constrained()->cascadeOnDelete();
            $table->foreignId('fisioterapeuta_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_records');
    }
};
