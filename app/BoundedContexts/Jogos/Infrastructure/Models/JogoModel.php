<?php

namespace App\BoundedContexts\Jogos\Infrastructure\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JogoModel extends Model
{
    use HasFactory;

    public $table = 'jogos';

    protected $fillable = [
        'id',
        'data',
        'hora_de_inicio',
        'hora_de_termino',
        'primeiro_time_id',
        'segundo_time_id'
    ];

    public function placar()
    {
        return $this->hasOne(PlacarModel::class, 'jogos_id', 'id');
    }

    public function gols()
    {
        return $this->hasMany(GolsModel::class, 'jogos_id', 'id');
    }

    public function cartoes()
    {
        return $this->hasMany(CartaoModel::class, 'jogos_id', 'id');
    }

    public function primeiroTime()
    {
        return $this->hasOne(TimeModel::class, 'id', 'primeiro_time_id');
    }

    public function segundoTime()
    {
        return $this->hasOne(TimeModel::class, 'id', 'segundo_time_id');
    }
}
