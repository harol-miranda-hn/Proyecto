<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'student_id', 'professor_id', 'status'];

    // Relación con el estudiante
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    // Relación con el profesor
    public function professor()
    {
        return $this->belongsTo(User::class, 'professor_id');
    }

    // Relación con los archivos
    public function files()
    {
        return $this->hasMany(File::class);
    }

    // Relación con los comentarios
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
