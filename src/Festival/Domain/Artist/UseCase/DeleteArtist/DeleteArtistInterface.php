<?php

namespace Festival\Domain\Artist\UseCase\DeleteArtist;

/**
 * L'interface DeleteArtistInterface est implémentée par notre UC DeleteArtist. Elle permet de faire de l'injection de dépendance 
 */ 
interface DeleteArtistInterface
{
    public function execute(DeleteArtistRequest $request, DeleteArtistPresenter $presenter): void;
}
