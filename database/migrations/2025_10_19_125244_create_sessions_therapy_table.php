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
        Schema::create('sessions_therapy', function (Blueprint $table) {
            $table->id();
            $table->foreignId('treatment_id')->constrained('treatments')->cascadeOnDelete();
            $table->foreignId('appointment_id')->constrained('appoinments')->cascadeOnDelete();
            $table->date('session_date');
            $table->text('subjective_data');
            $table->text('objective_data');
            $table->text('assessment');
            $table->text('treatment_applied');
            $table->text('homework_recommendations');
            $table->integer('duration_minutes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions_therapy');
    }
};
