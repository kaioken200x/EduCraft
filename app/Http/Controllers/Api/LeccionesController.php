<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\leccion;

class LeccionesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lecciones = Leccion::with('curso')
            ->select('id', 'curso_id', 'titulo', 'video_url')
            ->paginate(50);

        return response()->json($lecciones);
    }

    /**
     * Store a newly created resource in storage.
     * This method creates a new lesson for a course.
     * It validates the request data, ensuring that the course ID exists,
     * the title is provided, and the video URL is valid.
     * If the validation passes, it creates a new lesson and returns a success message.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'curso_id' => 'required|exists:cursos,id',
            'titulo' => 'required|string|max:255',
            'video_url' => 'required|url',
        ], [
            'curso_id.required' => 'El ID del curso es obligatorio.',
            'titulo.required' => 'El título de la lección es obligatorio.',
            'video_url.required' => 'La URL del video es obligatoria.',
            'video_url.url' => 'La URL del video debe ser una URL válida.'
        ]);

        $leccion = Leccion::create($validated);
        if (!$leccion) {
            return response()->json(['message' => 'Error al crear la lección.'], 500);
        }
        return response()->json(['message' => 'Lección creada con éxito.'], 201);
    }

    /**
     * Display the specified resource.
     * This method retrieves a specific lesson by its ID,
     * including its associated course details.
     * If the lesson is found, it returns the lesson data in JSON format.
     * If not found, it will throw a 404 error.
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id)
    {
        $leccion = Leccion::with('curso')->findOrFail($id);

        if (!$leccion) {
            return response()->json(['message' => 'Lección no encontrada.'], 404);
        }
        return response()->json($leccion);
    }

    /**
     * Update the specified resource in storage.
     * This method updates an existing lesson.
     * It validates the request data, allowing optional updates to the title and video URL.
     * If the validation passes, it updates the lesson and returns a success message.
     * @param \Illuminate\Http\Request $request
     * @param int $id
     */
    public function update(Request $request, int $id)
    {
        $leccion = Leccion::findOrFail($id);

        $validated = $request->validate([
            'titulo' => 'sometimes|string|max:255',
            'video_url' => 'sometimes|url',
        ], [
            'titulo.string' => 'El título debe ser una cadena de texto.',
            'video_url.url' => 'La URL del video debe ser una URL válida.'
        ]);
        
        if (!$leccion) {
            return response()->json(['message' => 'Lección no encontrada.'], 404);
        }

        $leccion->update($validated);
        return response()->json(['message' => 'Lección actualizada con éxito.'], 200);
    }

    /**
     * Remove the specified resource from storage.
     * This method deletes a lesson by its ID.
     * If the lesson is found and deleted successfully, it returns a success message.
     * If not found, it will throw a 404 error.
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id)
    {
        $leccion = Leccion::findOrFail($id);
        
        if (!$leccion) {
            return response()->json(['message' => 'Lección no encontrada.'], 404);
        }

        $leccion->delete();
        return response()->json(['message' => 'Lección eliminada con éxito.'], 200);
    }
}
