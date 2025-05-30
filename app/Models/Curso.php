<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Instructor;
use App\Models\leccion;
use App\Models\Favorito;
use App\Models\Comentario;

class Curso extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descripcion',
        'instructor_id',
    ];
    
    /*
    * Relación con el modelo Instructor
    * Un curso pertenece a un instructor
    * Un instructor puede tener varios cursos
    */
    public function instructor()
    {
        return $this->belongsTo(Instructor::class);
    }

    /*
    * Relación con el modelo leccion
    * Un curso puede tener varias lecciones
    * Una lección pertenece a un curso
    */
    public function lecciones()
    {
        return $this->hasMany(leccion::class);
    }
    
    /*
    * Relación con el modelo Favorito
    * Un curso puede ser favorito de varios usuarios
    * Un favorito pertenece a un curso
    */
    public function favoritos()
    {
        return $this->hasMany(Favorito::class);
    }

    /*
    * Relación con el modelo Comentario
    * Un curso puede tener varios comentarios
    * Un comentario pertenece a un curso
    */
    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }
}
