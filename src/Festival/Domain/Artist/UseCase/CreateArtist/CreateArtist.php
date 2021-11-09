<?php

namespace Festival\Domain\Artist\UseCase\CreateArtist;

use Festival\Domain\Artist\Entity\Artist;
use Festival\Domain\Artist\Entity\ArtistRepository;

class CreateArtist implements CreateArtistInterface
{

    public function __construct(
        private ArtistRepository $artistRepository
    )
    {}

    public function execute(CreateArtistRequest $request, CreateArtistPresenter $presenter): void
    {
        $response = new CreateArtistResponse();

        $this->createArtist($request, $response);

        $presenter->present($response);
    }

    private function createArtist(CreateArtistRequest $request, CreateArtistResponse $response)
    {
        $isValid = $this->validateInputs($request, $response);

        if ( $isValid )
        {
            $this->saveArtist($request, $response);
        }
    }

    private function validateInputs(CreateArtistRequest $request, CreateArtistResponse $response): bool
    {
        $artistName = $request->name;
        $artistDescription = $request->description;

        if ( !$artistName )
        {
            $response->addError('artistName', 'Artist name is empty !');
        }

        if ( !$artistDescription )
        {
            $response->addError('artistDescription', 'Artist description is empty !');
        }

        return $artistName && $artistDescription;
    }

    private function saveArtist(CreateArtistRequest $request, CreateArtistResponse $response): void
    {
        $artist = new Artist(
            $request->name,
            $request->description
        );

        $this->artistRepository->createArtist($artist);
        $response->artistIsCreate();
    }
}
