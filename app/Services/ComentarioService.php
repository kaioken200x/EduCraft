<?php
namespace App\Services;

use App\Models\Comentario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ComentarioService
{
    /**
     * Add a new comment to a course.
     *
     * @param array $data
     * @return Comentario
     * @throws ValidationException
     */
    public function addComentario(array $data): Comentario
    {
        $validator = Validator::make($data, [
            'curso_id' => 'required|exists:cursos,id',
            'comentario' => 'required|string|max:500',
            'calificacion' => 'required|integer|min:1|max:5',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $comentario = new Comentario();
        $comentario->user_id = Auth::id();
        $comentario->curso_id = $data['curso_id'];
        $comentario->comentario = $data['comentario'] ?? null;
        $comentario->calificacion = $data['calificacion'] ?? null;
        $comentario->save();

        return $comentario;
    }


    /**
     * Update an existing comment.
     *
     * @param int $id
     * @param array $data
     * @return Comentario|null
     */
    public function updateComentario(int $id, array $data): ?Comentario
    {
        $comentario = Comentario::find($id);

        if (!$comentario || $comentario->user_id !== Auth::id()) {
            return null; // Not found or not authorized
        }

        $validator = Validator::make($data, [
            'comentario' => 'sometimes|required|string|max:500',
            'calificacion' => 'sometimes|required|integer|min:1|max:5',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $comentario->comentario = $data['comentario'] ?? $comentario->comentario;
        $comentario->calificacion = $data['calificacion'] ?? $comentario->calificacion;
        $comentario->save();

        return $comentario;
    }
    
    /**
     * Delete an existing comment.
     *
     * @param int $id
     * @return Comentario|null
     */
    public function deleteComentario(int $id): bool
    {
        $comentario = Comentario::find($id);

        if ($comentario && $comentario->user_id === Auth::id()) {
            $comentario->delete();
            return true;
        }

        return false;
    }

    /**
     * Get all comments for a specific course.
     *
     * @param int $cursoId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getComentarios(int $cursoId)
    {
        return Comentario::where('curso_id', $cursoId)->get();
    }

    /**
     * Get all comments made by the authenticated user.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllComentarios()
    {
        return Comentario::where('user_id', Auth::id())->get();
    }
}

?>