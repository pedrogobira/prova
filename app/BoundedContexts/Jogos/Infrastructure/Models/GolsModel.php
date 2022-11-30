<?php

namespace App\BoundedContexts\Jogos\Infrastructure\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GolsModel extends Model
{
    use HasFactory;

    public $table = 'gols';

    protected $fillable = [
        'id',
        'jogos_id',
        'jogadores_id',
        'jogadores_times_id',
        'quantidade'
    ];

    public function jogo()
    {
        return $this->hasOne(JogoModel::class, 'id', 'jogos_id');
    }

    public function jogador()
    {
        return $this->hasOne(JogadorModel::class, 'id', 'jogadores_id');
    }
}
