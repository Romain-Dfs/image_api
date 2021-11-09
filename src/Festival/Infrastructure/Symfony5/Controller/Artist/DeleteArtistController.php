<?php

namespace Symfony5\Controller\Artist;

use Festival\Domain\Artist\UseCase\DeleteArtist\DeleteArtist;
use Festival\Domain\Artist\UseCase\DeleteArtist\DeleteArtistRequest;
use Festival\Presentation\Artist\Presenter\DeleteArtistJsonPresenter;
use Symfony5\View\Artist\DeleteArtistView;
use Symfony\Component\Routing\Annotation\Route;

/**
 * La classe DeleteArtistController est un controleur qui va recevoir une requête. Il va ensuite faire appel à nos classes de l'UC DeleteArtist 
 * @Route("/artist/{artistId}", methods={"DELETE"})
 */
class DeleteArtistController
{
    public function __invoke(
        DeleteArtist $deleteArtist,
        DeleteArtistJsonPresenter $deleteArtistPresenter,
        DeleteArtistView $deleteArtistView,
        int $artistId
    )
    {
        // On initialise un objet Request qui va contenir les informations à passer à l'UC
        $deleteArtistRequest = new DeleteArtistRequest();
        $deleteArtistRequest->artistId = $artistId;

        // On appel ensuite la méthode execute de notre UC qui s'occupe contient notre logique métier
        $deleteArtist->execute($deleteArtistRequest, $deleteArtistPresenter);

        // Enfin, on appel notre View qui va s'occuper de retourner les informations interprétables
        return $deleteArtistView->generateView($deleteArtistPresenter->viewModel());
    }
}
