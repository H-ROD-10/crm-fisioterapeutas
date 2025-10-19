<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appoinment extends Model
{
    /** @use HasFactory<\Database\Factories\AppoinmentFactory> */
    use HasFactory;

    protected $fillable = [
        'start_time',
        'end_time',
        'status',
        'patient_id',
        'fisioterapeuta_id',
        'notes',
    ];
}
