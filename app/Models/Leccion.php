<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Curso;

class Leccion extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'curso_id',
        'titulo',
        'video_url',
    ];

    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }
}
