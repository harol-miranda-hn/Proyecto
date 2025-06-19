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
    ];

    public function grados()
    {
        return $this->belongsToMany(Grado::class, 'asignatura_grado');
    }

    public function calificaciones()
    {
        return $this->hasMany(Calificacion::class);
    }
}
