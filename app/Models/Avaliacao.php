<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Avaliacao extends Model
{
    use HasFactory;

    protected $fillable = ['texto', 'user_id', 'anime_id', 'votos'];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function anime()
    {
        return $this->belongsTo(Anime::class);
    }
}
