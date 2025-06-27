<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsistenciaAlumno extends Model
{
    use HasFactory;

    protected $table = 'asistencia_alumnos';

    protected $fillable = [
        'asistencia_id',
        'alumno_id',
        'estado',
    ];

    public function asistencia()
    {
        return $this->belongsTo(Asistencia::class);
    }

    public function alumno()
    {
        return $this->belongsTo(Alumno::class);
    }
}
