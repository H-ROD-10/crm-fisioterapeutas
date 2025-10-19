<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    /** @use HasFactory<\Database\Factories\PatientFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'last_name',
        'email',
        'phone',
        'emergency_contact',
        'address',
        'birth_date',
        'gender',
        'dni',
        'photo',
        'fisioterapeuta_id',
    ];

    // Relaciones

    /**
     * Un Paciente pertenece a un Fisioterapeuta (opcional)
     */
    public function fisioterapeuta()
    {
        return $this->belongsTo(User::class, 'fisioterapeuta_id');
    }

    /**
     * Un Paciente puede tener muchas Citas
     */
    public function appointments()
    {
        return $this->hasMany(Appoinment::class);
    }

    /**
     * Un Paciente tiene un Historial Médico principal
     */
    public function medicalRecord()
    {
        return $this->hasOne(MedicalRecord::class);
    }

    /**
     * Un Paciente puede tener varios Tratamientos
     */
    public function treatments()
    {
        return $this->hasMany(Treatment::class);
    }
}
