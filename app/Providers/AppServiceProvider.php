<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Bounded Context: Times
        $this->app->bind(\App\BoundedContexts\Times\Domain\Interfaces\TimeRepositoryInterface::class, \App\BoundedContexts\Times\Infrastructure\TimeRepository::class);
        $this->app->bind(\App\BoundedContexts\Times\Domain\Interfaces\JogadorRepositoryInterface::class, \App\BoundedContexts\Times\Infrastructure\JogadorRepository::class);

        // Bounded Context: Jogos
        $this->app->bind(\App\BoundedContexts\Jogos\Domain\Interfaces\TimeRepositoryInterface::class, \App\BoundedContexts\Jogos\Infrastructure\Repositories\TimeRepository::class);
        $this->app->bind(\App\BoundedContexts\Jogos\Domain\Interfaces\JogadorRepositoryInterface::class, \App\BoundedContexts\Jogos\Infrastructure\Repositories\JogadorRepository::class);
        $this->app->bind(\App\BoundedContexts\Jogos\Domain\Interfaces\JogoRepositoryInterface::class, \App\BoundedContexts\Jogos\Infrastructure\Repositories\JogoRepository::class);
        $this->app->bind(\App\BoundedContexts\Jogos\Domain\Interfaces\ClassificacaoRepositoryInterface::class, \App\BoundedContexts\Jogos\Infrastructure\Repositories\ClassificacaoRepository::class);
        $this->app->bind(\App\BoundedContexts\Jogos\Domain\Interfaces\RankingDeJogadorRepositoryInterface::class, \App\BoundedContexts\Jogos\Infrastructure\Repositories\RankingDeJogadorRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
