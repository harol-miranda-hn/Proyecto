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
        'padece_enfermedad',
        'descripcion_enfermedad',
        'tiene_observaciones',
        'descripcion_observacion',
        'direccion',
        'fecha_matricula',
    ];

    public function matriculas()
    {
        return $this->hasMany(Matricula::class);
    }

    public function calificaciones()
    {
        return $this->hasMany(Calificacion::class);
    }

    public function promedioPorAsignatura($asignaturaId, $gradoId)
    {
        $calificaciones = $this->calificaciones()
            ->where('asignatura_id', $asignaturaId)
            ->where('grado_id', $gradoId)
            ->get()
            ->groupBy('tipo');

        $parciales = collect([
            optional($calificaciones->get('Parcial 1'))->first()->nota ?? 0,
            optional($calificaciones->get('Parcial 2'))->first()->nota ?? 0,
            optional($calificaciones->get('Parcial 3'))->first()->nota ?? 0,
        ]);

        $recuperacion = optional($calificaciones->get('Recuperación 1'))->first()->nota
            ?? optional($calificaciones->get('Recuperación 2'))->first()->nota;

        if ($recuperacion) {
            $min = $parciales->min();
            $index = $parciales->search($min);
            if ($recuperacion > $min) {
                $parciales[$index] = $recuperacion;
            }
        }

        return round($parciales->avg(), 2);
    }

}
