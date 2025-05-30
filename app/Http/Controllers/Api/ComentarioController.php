<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ComentarioService;

class ComentarioController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {

        $comentarioService = new ComentarioService();
        $comentarios = $comentarioService->getAllComentarios();

        return response()->json($comentarios);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'curso_id' => 'required|exists:cursos,id',
            'comentario' => 'required|string|max:500',
            'calificacion' => 'required|integer|min:1|max:5',
        ]);

        $comentarioService = new ComentarioService();
        $comentario = $comentarioService->addComentario($data);

        return response()->json($comentario, 201);
    }

    /**
     * Display the specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id)
    {
        $comentarioService = new ComentarioService();
        $comentarios = $comentarioService->getComentarios($id);

        return response()->json($comentarios);
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, int $id)
    {
        $data = $request->validate([
            'comentario' => 'sometimes|string|max:500',
            'calificacion' => 'sometimes|integer|min:1|max:5',
        ]);

        $comentarioService = new ComentarioService();
        $comentario = $comentarioService->updateComentario($id, $data);

        return response()->json($comentario);
    }

    /**
     * Remove the specified resource from storage.
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id)
    {
        $comentarioService = new ComentarioService();
        $comentario = $comentarioService->deleteComentario($id);

        if ($comentario) {
            return response()->json(['message' => 'Comentario eliminado con éxito'], 200);
        }

        return response()->json(['message' => 'Comentario no encontrado'], 404);
    }
}
