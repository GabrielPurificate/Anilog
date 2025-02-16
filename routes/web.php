<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $page = request()->query('page', 1);
    $response = Http::withoutVerifying()->get("https://api.jikan.moe/v4/anime?page={$page}");
    
    if (!$response->ok()) {
        return redirect()->route('dashboard')->with('error', 'Failed to fetch data from the API.');
    }

    $data = $response->json();

    return view('dashboard', [
        'animes' => $data['data'],
        'pagination' => $data['pagination']
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/anime/{id}', function ($id) {
    $response = Http::withoutVerifying()->get("https://api.jikan.moe/v4/anime/{$id}");

    if (!$response->ok()) {
        return redirect()->route('dashboard')->with('error', 'Falha ao obter detalhes do anime.');
    }

    $anime = $response->json()['data'];

    return view('anime.details', compact('anime'));
})->middleware(['auth', 'verified'])->name('anime.details');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
