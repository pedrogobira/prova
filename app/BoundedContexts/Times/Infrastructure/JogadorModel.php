<?php

namespace App\BoundedContexts\Times\Infrastructure;

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

    public function rankingDeJogador()
    {
        return $this->hasOne(RankingDeJogadorModel::class, 'jogadores_id', 'id');
    }
}
