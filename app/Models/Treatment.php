<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    /** @use HasFactory<\Database\Factories\TreatmentFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'status',
        'start_date',
        'end_date',
        'patient_id',
        'fisioterapeuta_id',
    ];

    // Relaciones

    /**
     * Un Tratamiento pertenece a un Paciente
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    /**
     * Un Tratamiento es gestionado por un Fisioterapeuta
     */
    public function fisioterapeuta()
    {
        return $this->belongsTo(User::class, 'fisioterapeuta_id');
    }

    /**
     * Un Tratamiento incluye muchas Sesiones
     */
    public function sessions()
    {
        return $this->hasMany(SessionTherapy::class);
    }
}
