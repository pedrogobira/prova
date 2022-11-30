<?php

namespace App\BoundedContexts\Jogos\Infrastructure\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeModel extends Model
{
    use HasFactory;

    public $table = 'times';

    protected $fillable = [
        'id',
        'nome'
    ];

    public function jogadores()
    {
        return $this->hasMany(JogadorModel::class, 'times_id', 'id');
    }

    public function gols() {
        return $this->hasMany(GolsModel::class, 'jogadores_times_id', 'id');
    }

    public function classificacao()
    {
        return $this->hasOne(ClassificacaoModel::class, 'times_id', 'id');
    }
}
