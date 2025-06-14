<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calificacion extends Model
{
    use HasFactory;

    protected $table = 'calificaciones';

    protected $fillable = [
        'asignatura_id',
        'tipo',
        'nota',
    ];

    public function asignatura()
    {
        return $this->belongsTo(Asignatura::class);
    }
}
