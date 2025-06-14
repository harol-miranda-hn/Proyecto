<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    use HasFactory;

    protected $table = 'alumnos';

    protected $fillable = [
        'numero_identidad',
        'nombre_completo',
        'telefono',
        'encargado_nombre',
        'encargado_telefono',
        'grado_id',
        'padece_enfermedad',
        'descripcion_enfermedad',
        'tiene_observaciones',
        'descripcion_observacion',
        'fecha_matricula',
    ];

    public function grado()
    {
        return $this->belongsTo(Grado::class);
    }

    public function asignaturas()
    {
        return $this->hasMany(Asignatura::class, 'alumno_id', 'numero_identidad');
    }
}
