<?php

namespace Symfony5\Controller\Artist;

use Festival\Domain\Artist\UseCase\ShowArtistList\ShowArtistList;
use Festival\Domain\Artist\UseCase\ShowArtistList\ShowArtistListRequest;
use Festival\Presentation\Artist\Presenter\ShowArtistListJsonPresenter;
use Symfony\Component\Routing\Annotation\Route;
use Symfony5\View\Artist\ShowArtistListView;

/**
 * La classe ShowArtistListController permet d'afficher l'ensemble de tous les artistes
 * @Route("/artist", methods={"GET"})
 */
class ShowArtistListController
{
    public function __invoke(
        ShowArtistList $artistList,
        ShowArtistListJsonPresenter $presenter,
        ShowArtistListView $view
    ){
        $artistList->execute(new ShowArtistListRequest(), $presenter);
        return $view->generateView($presenter->viewModel());
    }
}