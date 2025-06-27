<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    use HasFactory;

    protected $fillable = [
        'grado_id',
        'fecha',
    ];

    public function grado()
    {
        return $this->belongsTo(Grado::class);
    }

    public function asistenciaAlumnos()
    {
        return $this->hasMany(AsistenciaAlumno::class);
    }
}
