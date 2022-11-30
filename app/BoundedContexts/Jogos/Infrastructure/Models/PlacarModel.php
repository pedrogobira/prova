<?php

namespace App\BoundedContexts\Jogos\Infrastructure\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlacarModel extends Model
{
    use HasFactory;

    public $table = 'placares';

    protected $fillable = [
        'id',
        'jogos_id',
        'jogos_primeiro_time_id',
        'jogos_segundo_time_id',
        'gols_primeiro_time',
        'gols_segundo_time',
        'vencedor_id'
    ];

    public function jogo()
    {
        return $this->hasOne(JogoModel::class, 'id', 'jogos_id');
    }
}
