<?php

namespace Festival\Domain\Artist\UseCase\ShowArtistList;

use Festival\Domain\Artist\Entity\Artist;
use Festival\Domain\Artist\Entity\ArtistRepository;

class ShowArtistList implements ShowArtistListInterface
{

   public function __construct(
       private ArtistRepository $artistRepository
   ){}

    /**
     * On vient récupérer la liste des artistes, et on la passe au presenter
     */
    public function execute(ShowArtistListRequest $request, ShowArtistListPresenter $presenter): void
    {
        $response = new ShowArtistListResponse();

        $artistList = $this->artistRepository->getArtistList();
        $response->setArtistList($artistList);

        $presenter->present($response);
    }
}
