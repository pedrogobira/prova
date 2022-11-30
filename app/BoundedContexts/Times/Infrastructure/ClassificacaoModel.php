<?php

namespace App\BoundedContexts\Times\Infrastructure;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassificacaoModel extends Model
{
    use HasFactory;

    public $table = 'classificacoes';

    protected $fillable = [
        'id',
        'times_id',
        'pontos',
        'pontuacao_dos_cartoes'
    ];

    public function time()
    {
        return $this->hasOne(TimeModel::class, 'id', 'times_id');
    }
}
