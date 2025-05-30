<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Curso;

class Comentario extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'curso_id',
        'coentario',
        'calificacion'
    ];

    /**
     * Relación con el modelo Curso
     * Un comentario pertenece a un curso
     * Un curso puede tener varios comentarios
     */
    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }
    
    /**
     * Relación con el modelo User
     * Un comentario pertenece a un usuario
     * Un usuario puede tener varios comentarios
     */
    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
