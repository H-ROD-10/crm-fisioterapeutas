<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
    /** @use HasFactory<\Database\Factories\MedicalRecordFactory> */
    use HasFactory;

    protected $fillable = [
        'allergies',
        'pathologies',
        'medications',
        'past_surgeries',
        'notes_general',
        'patient_id',
        'fisioterapeuta_id',
    ];
}
