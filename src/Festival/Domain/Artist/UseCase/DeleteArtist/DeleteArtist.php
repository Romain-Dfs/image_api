<?php

namespace Festival\Domain\Artist\UseCase\DeleteArtist;

use Festival\Domain\Artist\Entity\ArtistRepository;

/**
 * La classe DeleteArtist est notre UC où s'exécute toute notre logique métier
 */
class DeleteArtist implements DeleteArtistInterface
{

    public function __construct(
        private ArtistRepository $artistRepository
    )
    {}

    public function execute(DeleteArtistRequest $request, DeleteArtistPresenter $presenter): void
    {
        $response = new DeleteArtistResponse();

        $isValid = $this->validateArtistToBeDeleted($request, $response);

        if ( $isValid ) {
            $this->deleteArtist($request, $response);
        }

        $presenter->present($response);
    }

    private function validateArtistToBeDeleted(DeleteArtistRequest $request, DeleteArtistResponse $response): bool
    {
        $artist = $this->artistRepository->getArtist($request->artistId);
        $artistCanBeDelete = true;

        if ( !$artist ) {
            $response->addError('artistNotFound', 'No artist corresponds to the id you indicated !');
            $artistCanBeDelete = false;
        }

        return $artistCanBeDelete;
    }

    private function deleteArtist(DeleteArtistRequest $request, DeleteArtistResponse $response): void
    {
        $this->artistRepository->deleteArtist($request->artistId);
        $response->artistIsDelete();
    }
}
