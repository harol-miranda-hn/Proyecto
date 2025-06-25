<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    use HasFactory;

    protected $table = 'matriculas';

    protected $fillable = [
        'alumno_id',
        'grado_id',
        'fecha_matricula',
    ];

    public function alumno()
    {
        return $this->belongsTo(Alumno::class);
    }

    public function grado()
    {
        return $this->belongsTo(Grado::class);
    }

    public function calificaciones()
    {
        return $this->hasMany(Calificacion::class);
    }

}
