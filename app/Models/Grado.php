<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grado extends Model
{
    use HasFactory;

    protected $table = 'grados';

    protected $fillable = [
        'curso',
        'modalidad',
        'jornada',
        'seccion',
        'matricula',
    ];

    public function asignaturas()
    {
        return $this->belongsToMany(Asignatura::class, 'asignatura_grado');
    }

    public function matriculas()
    {
        return $this->hasMany(Matricula::class);
    }

    public function calificaciones()
    {
        return $this->hasMany(Calificacion::class);
    }

    public function asistencias()
    {
        return $this->hasMany(Asistencia::class);
    }

}
