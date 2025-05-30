<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Curso;
use App\Services\CursoRatingService;

class CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Curso::with(['instructor', 'lecciones', 'comentarios', 'favoritos'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'instructor_id' => 'required|exists:instructors,id',
        ],
        [
            'titulo.required' => 'El título del curso es obligatorio.',
            'instructor_id.exists' => 'El instructor seleccionado no existe.',
        ]);

        $curso = Curso::create($validated);
        
        return response()->json($curso, 201);
    }

    /**
     * Display the specified resource.
     * @param  int  $id
     */
    public function show($id)
    {
        $curso = Curso::with('instructor', 'lecciones', 'comentarios')->findOrFail($id);
        $curso->rating_promedio = app(CursoRatingService::class)->calcularPromedio($curso);
    
        return response()->json($curso);
    }
    
    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param int $id   
     */
    public function update(Request $request, $id)
    {
        $curso = Curso::findOrFail($id);

        $validated = $request->validate([
            'titulo' => 'sometimes|string|max:255',
            'descripcion' => 'nullable|string',
            'instructor_id' => 'sometimes|exists:instructors,id',
        ]);

        $curso->update($validated);
        return $curso;
    }

    /**
     * Remove the specified resource from storage.
     * @param  int  $id
     */
    public function destroy($id)
    {
        $curso = Curso::findOrFail($id);
        $curso->delete();
        return response()->json(['message' => 'Curso eliminado.'], 200);
    }
}
