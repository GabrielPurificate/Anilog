<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Avaliacao;
use App\Models\Anime;

class AvaliacaoController extends Controller
{
    /**
     * Cria uma nova avaliação para um anime.
     */
    public function store(Request $request)
    {
        $request->validate([
            'mal_id' => 'required|integer',
            'texto' => 'required|string',
        ]);

        // Verifica se o anime já existe no banco, senão, cria um novo
        $animeController = new AnimeController();
        $anime = $animeController->buscarOuCriarAnime($request->mal_id);

        if (!$anime) {
            return response()->json(['error' => 'Erro ao criar ou buscar o anime'], 500);
        }

        // Cria a avaliação associada ao usuário autenticado
        $avaliacao = Avaliacao::create([
            'texto' => $request->texto,
            'usuario_id' => Auth::id(),
            'anime_id' => $anime->id,
            'votos' => 0,
        ]);

        return response()->json($avaliacao, 201);
    }

    /**
     * Exibe todas as avaliações de um anime.
     */
    public function listarAvaliacoes(int $malId)
    {
        $anime = Anime::where('mal_id', $malId)->first();

        if (!$anime) {
            return response()->json(['error' => 'Anime não encontrado'], 404);
        }

        return response()->json($anime->avaliacoes);
    }
}
