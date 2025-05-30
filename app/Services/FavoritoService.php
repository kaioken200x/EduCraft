<?php
namespace App\Services;
use App\Models\Favorito;
use Illuminate\Support\Facades\Auth;

class FavoritoService
{
    public function addFavorito(int $cursoId): Favorito
    {
        $favorito = new Favorito();
        $favorito->user_id = Auth::id();
        $favorito->curso_id = $cursoId;
        $favorito->save();

        return $favorito;
    }

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

    public function getFavoritos()
    {
        return Favorito::where('user_id', Auth::id())->get();
    }
}
?>