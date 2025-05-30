<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CursoController;
use App\Http\Controllers\Api\InstructorController;
use App\Http\Controllers\Api\ComentarioController;
use App\Http\Controllers\Api\FavoritoController;
use App\Http\Controllers\Api\LeccionesController;
use App\Http\Controllers\Api\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    
    Route::get('/cursos', [CursoController::class, 'index']);
    Route::post('/cursos', [CursoController::class, 'store']);
    Route::get('/cursos/{id}', [CursoController::class, 'show']);
    Route::put('/cursos/{id}', [CursoController::class, 'update']);
    Route::delete('/cursos/{id}', [CursoController::class, 'destroy']);
    
    Route::get('/instructores', [InstructorController::class, 'index']);
    Route::post('/instructores', [InstructorController::class, 'store']);
    Route::get('/instructores/{id}', [InstructorController::class, 'show']);
    Route::put('/instructores/{id}', [InstructorController::class, 'update']);
    Route::delete('/instructores/{id}', [InstructorController::class, 'destroy']);

    Route::get('/comentarios', [ComentarioController::class, 'index']);
    Route::post('/comentarios', [ComentarioController::class, 'store']);
    Route::get('/comentarios/{cursoId}', [ComentarioController::class, 'show']);
    Route::put('/comentarios/{id}', [ComentarioController::class, 'update']);
    Route::delete('/comentarios/{id}', [ComentarioController::class, 'destroy']);

    Route::get('/favoritos', [FavoritoController::class, 'index']);
    Route::post('/favoritos', [FavoritoController::class, 'store']);
    Route::get('/favoritos', [FavoritoController::class, 'show']);
    Route::delete('/favoritos/{id}', [FavoritoController::class, 'destroy']);
    
    Route::get('/leccion', [LeccionesController::class, 'index']);
    Route::post('/leccion', [LeccionesController::class, 'store']);
    Route::get('/leccion/{id}', [LeccionesController::class, 'show']);
    Route::put('/leccion/{id}', [LeccionesController::class, 'update']);
    Route::delete('/leccion/{id}', [LeccionesController::class, 'destroy']);
    
    Route::post('/logout', [AuthController::class, 'logout']);
});

?>