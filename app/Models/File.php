<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'path', 'project_id'];

    // Relación con el proyecto
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
