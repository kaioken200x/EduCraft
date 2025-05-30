<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Instructor extends Model
{
    use Hasfactory;

    protected $fillable = [
        'name',
        'email',
    ];

    public function cursos()
    {
        return $this->hasMany(Curso::class);
    }
}
