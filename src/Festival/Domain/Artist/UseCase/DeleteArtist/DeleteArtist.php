<?php

namespace Festival\Domain\Artist\UseCase\DeleteArtist;

/**
 * La classe DeleteArtist est notre UC où s'exécute toute notre logique métier
 */
class DeleteArtist implements DeleteArtistInterface
{

    public function __construct()
    {}

    public function execute(DeleteArtistRequest $request, DeleteArtistPresenter $presenter): void
    {
        $response = new DeleteArtistResponse();
        // TODO : Implement the logic
        $presenter->present($response);
    }
}
