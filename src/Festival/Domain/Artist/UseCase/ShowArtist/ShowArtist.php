<?php

namespace Festival\Domain\Artist\UseCase\ShowArtist;

use Festival\Domain\Artist\Entity\ArtistRepository;

class ShowArtist implements ShowArtistInterface
{

   public function __construct(private ArtistRepository $artistRepository)
   {}

   public function execute(ShowArtistRequest $request, ShowArtistPresenter $presenter): void
   {
       // On initialise une response
       $response = new ShowArtistResponse();

       $artist = $this->artistRepository->getArtist($request->artistId);

       if ( $artist ) {
           $response->setArtist($artist);
       } else {
           $response->addError('recoveredArtist', 'No artist corresponds to the id indicated !');
       }

       $presenter->present($response);
   }

}
