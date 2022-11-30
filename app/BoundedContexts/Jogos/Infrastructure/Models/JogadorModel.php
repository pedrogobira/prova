<?php

namespace App\BoundedContexts\Jogos\Infrastructure\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JogadorModel extends Model
{
    use HasFactory;

    public $table = 'jogadores';

    protected $fillable = [
        'id',
        'nome',
        'cpf',
        'numero',
        'times_id'
    ];

    public function time()
    {
        return $this->hasOne(TimeModel::class, 'id', 'times_id');
    }

    public function gols()
    {
        return $this->hasMany(GolsModel::class, 'jogadores_id', 'id');
    }

    public function cartoes()
    {
        return $this->hasMany(CartaoModel::class, 'jogadores_id', 'id');
    }

    public function rankingDeJogadores()
    {
        return $this->hasOne(RankingDeJogadorModel::class, 'jogadores_id', 'id');
    }
}
