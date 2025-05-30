<?php
namespace App\Services;
use App\Models\Curso;

class CursoRatingService
{
    /**
     * Calculate the average rating for a course.
     *
     * @param Curso $curso
     * @return float
     */
    public function calcularPromedio(Curso $curso): float
    {
       return round($curso->comentarios->avg('calificacion'), 2);
    }
}