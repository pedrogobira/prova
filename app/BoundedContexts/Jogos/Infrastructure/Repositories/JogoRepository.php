<?php

namespace App\BoundedContexts\Jogos\Infrastructure\Repositories;

use App\BoundedContexts\Jogos\Domain\Entities\Cartao;
use App\BoundedContexts\Jogos\Domain\Entities\Classificacao;
use App\BoundedContexts\Jogos\Domain\Entities\Gols;
use App\BoundedContexts\Jogos\Domain\Entities\Jogador;
use App\BoundedContexts\Jogos\Domain\Entities\Jogo;
use App\BoundedContexts\Jogos\Domain\Entities\Placar;
use App\BoundedContexts\Jogos\Domain\Entities\RankingDeJogador;
use App\BoundedContexts\Jogos\Domain\Interfaces\JogoRepositoryInterface;
use App\BoundedContexts\Jogos\Infrastructure\Models\JogoModel;
use Illuminate\Support\Facades\DB;

class JogoRepository implements JogoRepositoryInterface
{
    public function __construct(private JogoModel $model)
    {
    }

    public function store(Jogo $jogo)
    {
        DB::transaction(function () use ($jogo) {
            $this->storeJogo($jogo);
            $this->updatePontuacoes($jogo);
        });
    }

    private function storeJogo(Jogo $jogo)
    {
        $id = DB::table($this->model->table)->insertGetId([
            'data' => $jogo->getData(),
            'hora_de_inicio' => $jogo->getHoraDeInicio(),
            'hora_de_termino' => $jogo->getHoraDeTermino(),
            'primeiro_time_id' => $jogo->getPrimeiroTimeId(),
            'segundo_time_id' => $jogo->getSegundoTimeId()
        ]);

        foreach ($jogo->getJogadores() as $jogador) {
            if ($jogador->getGols()[0]->getQuantidade() > 0) {
                DB::table('gols')->insert([
                    'jogos_id' => $id,
                    'jogadores_id' => $jogador->id,
                    'jogadores_times_id' => $jogador->times_id,
                    'quantidade' => $jogador->getGols()[0]->getQuantidade()
                ]);
            }

            if ($jogador->getCartoes()[0]->getCor() != "") {
                DB::table('cartoes')->insert([
                    'jogadores_id' => $jogador->id,
                    'jogadores_times_id' => $jogador->times_id,
                    'jogos_id' => $id,
                    'cor' => $jogador->getCartoes()[0]->getCor()
                ]);
            }
        }

        DB::table('placares')->insert([
            'jogos_id' => $id,
            'jogos_primeiro_time_id' => $jogo->getPlacar()->getPrimeiroTimeId(),
            'jogos_segundo_time_id' => $jogo->getPlacar()->getSegundoTimeId(),
            'gols_primeiro_time' => $jogo->getPlacar()->getGolsPrimeiroTime(),
            'gols_segundo_time' => $jogo->getPlacar()->getGolsSegundoTime(),
            'vencedor_id' => $jogo->getPlacar()->getVencedorId()
        ]);
    }

    private function updatePontuacoes(Jogo $jogo)
    {
        foreach ($jogo->getClassificacaoDosTimesParticipantes() as $classificacao) {
            DB::table('classificacoes')->where('id', '=', $classificacao->id)->update([
                'times_id' => $classificacao->getTimesId(),
                'pontos' => $classificacao->getPontos(),
                'pontuacao_dos_cartoes' => $classificacao->getPontuacaoDosCartoes()
            ]);
        }

        foreach ($jogo->getRankingDosJogadoresParticipantes() as $ranking) {
            DB::table('ranking_de_jogadores')->where('id', '=', $ranking->id)->update([
                'jogadores_id' => $ranking->getJogadoresId(),
                'gols' => $ranking->getGols(),
                'pontuacao_dos_cartoes' => $ranking->getPontuacaoDosCartoes()
            ]);
        }
    }

    public function update(Jogo $jogo)
    {
        DB::transaction(function () use ($jogo) {
            $this->storeJogo($jogo);
            $this->updatePontuacoes($jogo);
        });
    }

    public function delete(Jogo $registro)
    {
        DB::transaction(function () use ($registro) {
            DB::table('cartoes')->where('jogos_id', '=', $registro->id)->delete();
            DB::table('gols')->where('jogos_id', '=', $registro->id)->delete();
            DB::table('placares')->where('jogos_id', '=', $registro->id)->delete();
            DB::table('jogos')->delete($registro->id);
            $this->updatePontuacoes($registro);
        });
    }

    public function getAll(): array
    {
        $registros = $this->model::all();
        $retorno = [];

        foreach ($registros as $registro) {
            $placar = $registro->placar;
            $placar = new Placar(primeiroTimeId: $placar->jogos_primeiro_time_id, segundoTimeId: $placar->jogos_segundo_time_id, golsPrimeiroTime: $placar->gols_primeiro_time, golsSegundoTime: $placar->gols_segundo_time, vencedorId: $placar->vencedor_id);
            $retorno[] = new Jogo(data: $registro->data, horaDeInicio: $registro->hora_de_inicio, horaDeTermino: $registro->hora_de_termino, primeiroTimeId: $registro->primeiro_time_id, segundoTimeId: $registro->segundo_time_id, placar: $placar, id: $registro->id);
        }
        return $retorno;
    }

    public function getById(int $id): Jogo|null
    {
        $registro = $this->model::find($id);

        if (is_null($registro)) {
            return null;
        }

        $jogadoresCollection = ($registro->primeiroTime->jogadores)->merge($registro->segundoTime->jogadores);

        $jogadores = [];
        $rankingDeJogadores = [];
        foreach ($jogadoresCollection as $jogador) {
            $entity = new Jogador(cpf: $jogador->cpf, id: $jogador->id, times_id: $jogador->times_id);

            $golsModel = $jogador->gols->first(fn($gol) => $gol->jogos_id == $registro->id);

            if (!is_null($golsModel)) {
                $gols = new Gols(jogadores_id: $golsModel->jogadores_id, jogadores_times_id: $golsModel->jogadores_times_id, quantidade: $golsModel->quantidade, jogos_id: $golsModel->jogos_id, id: $golsModel->id);
                $entity->setGols([$gols]);
            }

            $cartaoModel = $jogador->cartoes->first(fn($cartao) => $cartao->jogos_id == $registro->id);

            if (!is_null($cartaoModel)) {
                $cartao = new Cartao(jogadores_id: $cartaoModel->jogadores_id, jogadores_times_id: $cartaoModel->jogadores_times_id, cor: $cartaoModel->cor, jogos_id: $cartaoModel->jogos_id, id: $cartaoModel->id);
                $entity->setCartoes([$cartao]);
            }

            $ranking = $jogador->rankingDeJogadores;
            $rankingDeJogadores[] = new RankingDeJogador($ranking->jogadores_id, $ranking->gols, $ranking->pontuacao_dos_cartoes, $ranking->id);

            $jogadores[] = $entity;
        }

        $placar = $registro->placar;
        $placar = new Placar(primeiroTimeId: $placar->jogos_primeiro_time_id, segundoTimeId: $placar->jogos_segundo_time_id, golsPrimeiroTime: $placar->gols_primeiro_time, golsSegundoTime: $placar->gols_segundo_time, vencedorId: $placar->vencedor_id);

        $primeiro = $registro->primeiroTime->classificacao;
        $segundo = $registro->segundoTime->classificacao;
        $classificacaoPrimeiroTime = new Classificacao(times_id: $primeiro->times_id, pontos: $primeiro->pontos, pontuacaoDosCartoes: $primeiro->pontuacao_dos_cartoes, id: $primeiro->id);
        $classificacaoSegundoTime = new Classificacao(times_id: $segundo->times_id, pontos: $segundo->pontos, pontuacaoDosCartoes: $segundo->pontuacao_dos_cartoes, id: $segundo->id);

        return new Jogo(data: $registro->data, horaDeInicio: $registro->hora_de_inicio, horaDeTermino: $registro->hora_de_termino, primeiroTimeId: $registro->primeiro_time_id, segundoTimeId: $registro->segundo_time_id, placar: $placar, jogadores: $jogadores, classificacaoDosTimesParticipantes: [$classificacaoPrimeiroTime, $classificacaoSegundoTime], rankingDosJogadoresParticipantes: $rankingDeJogadores, id: $registro->id);
    }
}
