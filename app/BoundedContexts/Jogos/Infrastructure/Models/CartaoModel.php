<?php

namespace App\BoundedContexts\Jogos\Infrastructure\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartaoModel extends Model
{
    use HasFactory;

    public $table = 'cartoes';

    protected $fillable = [
        'id',
        'jogadores_id',
        'jogadores_times_id',
        'jogos_id',
        'cor'
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
