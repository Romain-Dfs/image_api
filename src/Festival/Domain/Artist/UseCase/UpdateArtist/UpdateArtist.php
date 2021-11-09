<?php

namespace Festival\Domain\Artist\UseCase\UpdateArtist;

use Festival\Domain\Artist\Entity\ArtistRepository;

/**
 * La classe UpdateArtist permet de mettre à jour un artiste
 */
class UpdateArtist implements UpdateArtistInterface
{

   public function __construct(
       private ArtistRepository $artistRepository
   ){}

    /**
     * La méthode execute est appelé par le controleur UpdateArtistController
     */
   public function execute(UpdateArtistRequest $request, UpdateArtistPresenter $presenter): void
   {
       // On initialise la réponse
       $response = new UpdateArtistResponse();

       $this->updateArtist($request, $response);

       $presenter->present($response);
   }

   private function updateArtist(UpdateArtistRequest $request, UpdateArtistResponse $response)
   {
       $isValid = $this->validateInputs($request, $response);

       if ( $isValid ) {
           $this->saveArtist($request, $response);
       }
   }

   private function validateInputs(UpdateArtistRequest $request, UpdateArtistResponse $response): bool
   {
       $artist = $request->artist;
       $artistId = $artist->id();
       $artistName = $artist->name();
       $artistDescription = $artist->description();

       if ( !$artistId ) {
           $response->addError('artistId', 'The artist Id must not be null !');
       }

       if ( !$artistName )
       {
           $response->addError('artistName', 'Artist name is empty !');
       }

       if ( !$artistDescription )
       {
           $response->addError('artistDescription', 'Artist description is empty !');
       }

       return $artistId && $artistDescription && $artistName;
   }


   private function saveArtist(UpdateArtistRequest $request, UpdateArtistResponse $response): void
   {
       $artist = $this->artistRepository->updateArtist($request->artist);

       // On vérifie que l'artist n'est pas null et en fonction, on initialise l'objet UpdateArtistResponse
       if ( $artist ) {
           $response->setArtist($artist);
       } else {
           $response->addError('updatedArtist', 'The artist you want to update does not exist!');
       }
   }
}
