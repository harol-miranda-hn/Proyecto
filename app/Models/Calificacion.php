<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calificacion extends Model
{
    use HasFactory;

    protected $table = 'calificaciones';

    protected $fillable = [
        'matricula_id',
        'asignatura_id',
        'parcial_1',
        'parcial_2',
        'parcial_3',
        'parcial_4',
    ];

    // Relaciones
    public function matricula()
    {
        return $this->belongsTo(Matricula::class);
    }

    public function asignatura()
    {
        return $this->belongsTo(Asignatura::class);
    }

    // Accesor para el promedio
    public function getPromedioAttribute()
    {
        $notas = array_filter([
            $this->parcial_1,
            $this->parcial_2,
            $this->parcial_3,
            $this->parcial_4,
        ], fn($nota) => $nota !== null);

        return count($notas) ? round(array_sum($notas) / count($notas), 2) : null;
    }

    // Accesor para saber si aplica (Aprobó, Reprobó, Abandonó)
    public function getAplicaAttribute()
    {
        $notas = array_filter([
            $this->parcial_1,
            $this->parcial_2,
            $this->parcial_3,
            $this->parcial_4,
        ], fn($nota) => $nota !== null);

        if (count($notas) < 3) {
            return 'Abandonó';
        }

        return $this->promedio >= 70 ? 'Aprobó' : 'Reprobó';
    }
}
