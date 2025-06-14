<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asignatura extends Model
{
    use HasFactory;

    protected $table = 'asignaturas';

    protected $fillable = [
        'nombre',
        'calificacion',
        'alumno_id',
    ];

    public function alumno()
    {
        return $this->belongsTo(Alumno::class, 'alumno_id', 'numero_identidad');
    }

    public function calificaciones()
    {
        return $this->hasMany(Calificacion::class);
    }
}
