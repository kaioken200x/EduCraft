<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Curso;
use App\Models\User;

class Favorito extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'curso_id',
    ];

    /**
     * Relación con el modelo User
     * Un favorito pertenece a un usuario
     * Un usuario puede tener varios favoritos
     */
    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relación con el modelo Curso
     * Un favorito pertenece a un curso
     * Un curso puede ser favorito de varios usuarios
     */
    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }
}
