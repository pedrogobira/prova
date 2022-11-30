<?php

namespace App\BoundedContexts\Jogos\Infrastructure\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RankingDeJogadorModel extends Model
{
    use HasFactory;

    public $table = 'ranking_de_jogadores';

    protected $fillable = [
        'id',
        'jogadores_id',
        'gols',
        'pontuacao_dos_cartoes'
    ];

    public function jogador()
    {
        return $this->hasOne(JogadorModel::class, 'id', 'jogadores_id');
    }
}
