<?php

namespace App\BoundedContexts\Jogos\Domain\Actions;

use App\BoundedContexts\Jogos\Domain\Entities\Cartao;
use App\BoundedContexts\Jogos\Domain\Entities\Gols;
use App\BoundedContexts\Jogos\Domain\Entities\Jogador;
use App\BoundedContexts\Jogos\Domain\Entities\Jogo;
use App\BoundedContexts\Jogos\Domain\Entities\Placar;
use App\BoundedContexts\Jogos\Domain\Interfaces\JogadorRepositoryInterface;
use App\BoundedContexts\Jogos\Domain\Interfaces\TimeRepositoryInterface;
use App\BoundedContexts\Shared\Exceptions\InformacaoErradaException;
use App\BoundedContexts\Shared\Exceptions\JogadorNaoEncontradoException;
use App\BoundedContexts\Shared\Exceptions\TimeIncompletoException;
use App\BoundedContexts\Shared\Exceptions\TimeNaoEncontradoException;
use Carbon\Carbon;
use function mb_strtoupper;

class CriaJogoAction
{
    public function __construct(private TimeRepositoryInterface $timeRepository, private JogadorRepositoryInterface $jogadorRepository, private AtualizaClassificacaoAction $atualizaClassificacaoAction, private AtualizaRankingDosJogadoresAction $atualizaRankingDosJogadoresAction)
    {
    }

    public function execute(string $data, string $horaDeInicio, string $horaDeTermino, int $primeiroTimeId, int $segundoTimeId, array $jogadores): Jogo
    {
        $objetoData = Carbon::createFromFormat('d/m/Y', $data);
        $objetoHoraDeInicio = Carbon::createFromFormat('d/m/Y H:i', $objetoData->format('d/m/Y') . ' ' . $horaDeInicio);
        $objetoHoraDeTermino = Carbon::createFromFormat('d/m/Y H:i', $objetoData->format('d/m/Y') . ' ' . $horaDeTermino);

        if (is_null($objetoData) || is_null($objetoHoraDeInicio) || is_null($objetoHoraDeTermino)) {
            throw new InformacaoErradaException();
        }

        $primeiroTime = $this->timeRepository->getById($primeiroTimeId);
        $segundoTime = $this->timeRepository->getById($segundoTimeId);

        if (is_null($primeiroTime) || is_null($segundoTime)) {
            throw new TimeNaoEncontradoException();
        }

        if (count($primeiroTime->getJogadores()) != 5 || count($segundoTime->getJogadores()) != 5) {
            throw new TimeIncompletoException();
        }

        $objetosJogador = [];
        foreach ($jogadores as $jogador) {
            $registroJogador = $this->jogadorRepository->getByCpf($jogador['cpf']);

            if (is_null($registroJogador)) {
                throw new JogadorNaoEncontradoException();
            }

            if (!in_array($registroJogador->times_id, [$primeiroTimeId, $segundoTimeId])) {
                throw new InformacaoErradaException();
            }

            if (!in_array(mb_strtoupper($jogador['cartao']), ['V', 'A', null])) {
                throw new InformacaoErradaException();
            }

            $gols = new Gols($registroJogador->id, $registroJogador->times_id, $jogador['gols']);
            $cartao = new Cartao($registroJogador->id, $registroJogador->times_id, mb_strtoupper($jogador['cartao']));
            $objetosJogador[] = new Jogador($registroJogador->cpf, $registroJogador->id, $registroJogador->times_id, [$gols], [$cartao]);
        }

        $golsPrimeiroTime = 0;
        $golsSegundoTime = 0;
        foreach ($objetosJogador as $objeto) {
            $objeto->times_id == $primeiroTimeId ? $golsPrimeiroTime += $objeto->getGols()[0]->getQuantidade() : $golsSegundoTime += $objeto->getGols()[0]->getQuantidade();
        }

        if ($golsPrimeiroTime > $golsSegundoTime) {
            $vencedorId = $primeiroTimeId;
        } elseif ($golsSegundoTime > $golsPrimeiroTime) {
            $vencedorId = $segundoTimeId;
        } else {
            $vencedorId = null;
        }

        $placar = new Placar($primeiroTimeId, $segundoTimeId, $golsPrimeiroTime, $golsSegundoTime, $vencedorId);
        $jogo = new Jogo(data: $objetoData->format('Y-m-d'), horaDeInicio: $objetoHoraDeInicio->format('H:i'), horaDeTermino: $objetoHoraDeTermino->format('H:i'), primeiroTimeId: $primeiroTimeId, segundoTimeId: $segundoTimeId, placar: $placar, jogadores: $objetosJogador);
        $jogo = $this->atualizaClassificacaoAction->execute($jogo);
        $jogo = $this->atualizaRankingDosJogadoresAction->execute($jogo);
        return $jogo;
    }
}
