<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Anime;

class AnimeController extends Controller
{
    public function show($malId)
    {
        $anime = Anime::where('mal_id', $malId)->first();
        
        if (!$anime) {
            return redirect()->back()->with('error', 'Anime não encontrado');
        }

        return view('anime.detalhes', compact('anime'));
    }

    /**
     * Verifica se um anime existe no banco ou busca na API do Jikan para criar um novo.
     */
    public function buscarOuCriarAnime(int $malId)
    {
        // Verifica se o anime já existe no banco
        $anime = Anime::where('mal_id', $malId)->first();

        if ($anime) {
            return $anime;
        }

        // Faz a requisição à API Jikan
        $response = Http::get("https://api.jikan.moe/v4/anime/{$malId}");

        if ($response->failed()) {
            return response()->json(['error' => 'Não foi possível obter dados do anime'], 404);
        }

        $dadosAnime = $response->json()['data'];

        // Cria um novo anime no banco
        $anime = Anime::create([
            'mal_id' => $dadosAnime['mal_id'],
        ]);

        return $anime;
    }
}
