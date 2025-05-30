<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\FavoritoService;

class FavoritoController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\JsonResponse
     * 
     */
    public function index()
    {
        $favoritoService = new FavoritoService();
        $favoritos = $favoritoService->getFavoritos();

        return response()->json($favoritos);
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'curso_id' => 'required|exists:cursos,id',
        ]);

        if (!$data['curso_id']) {
            return response()->json(['message' => 'El ID del curso es obligatorio'], 400);
        }

        $favoritoService = new FavoritoService();
        $favorito = $favoritoService->addFavorito($data['curso_id']);

        return response()->json($favorito, 201);
    }

    /**
     * Display the specified resource.
     * @return \Illuminate\Http\JsonResponse
     */
    public function show()
    {
        $favoritoService = new FavoritoService();
        $favoritos = $favoritoService->getFavoritos();

        return response()->json($favoritos);
    }

    /**
     * Remove the specified resource from storage.
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $favoritoService = new FavoritoService();
        $result = $favoritoService->removeFavorito($id);

        if ($result) {
            return response()->json(['message' => 'Favorito eliminado correctamente'], 200);
        }

        return response()->json(['message' => 'Favorito no encontrado'], 404);
    }
}
