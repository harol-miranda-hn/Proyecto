<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsignaturaGrado extends Model
{
    use HasFactory;

    protected $table = 'asignatura_grado';

    protected $fillable = [
        'grado_id',
        'asignatura_id',
    ];

    public function grado()
    {
        return $this->belongsTo(Grado::class);
    }

    public function asignatura()
    {
        return $this->belongsTo(Asignatura::class);
    }
}

