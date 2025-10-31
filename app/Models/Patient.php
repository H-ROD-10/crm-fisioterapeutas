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

    // Accessors
    
    /**
     * Obtener la URL completa de la foto
     */
    public function getPhotoAttribute($value)
    {
        if (!$value) {
            return null;
        }
        
        // Si ya es una URL completa, devolverla tal como está
        if (str_starts_with($value, 'http')) {
            return $value;
        }
        
        // Si es una ruta relativa, convertirla a URL completa
        return asset('storage/' . $value);
    }

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
