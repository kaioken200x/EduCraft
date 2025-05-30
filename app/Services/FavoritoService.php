<?php
namespace App\Services;
use App\Models\Favorito;
use Illuminate\Support\Facades\Auth;

class FavoritoService
{
    /**
     * Add a course to the user's favorites.
     *
     * @param int $cursoId
     * @return Favorito
     */
    public function addFavorito(int $cursoId): Favorito
    {
        $favorito = new Favorito();
        $favorito->user_id = Auth::id();
        $favorito->curso_id = $cursoId;
        $favorito->save();

        return $favorito;
    }

    /**
     * Remove a course from the user's favorites.
     *
     * @param int $cursoId
     * @return bool
     */
    public function removeFavorito($cursoId): bool
    {
        $favorito = Favorito::where('user_id', Auth::id())
                            ->where('curso_id', $cursoId)
                            ->first();

        if ($favorito) {
            $favorito->delete();
            return true;
        }

        return false;
    }
    /*/
     * Get all favorite courses for the authenticated user.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getFavoritos()
    {
        return Favorito::where('user_id', Auth::id())->get();
    }
}
?>