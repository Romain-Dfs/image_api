<?php

namespace Symfony5\Controller\Artist;

use Festival\Domain\Artist\UseCase\ShowArtist\ShowArtist;
use Festival\Domain\Artist\UseCase\ShowArtist\ShowArtistRequest;
use Festival\Presentation\Artist\Presenter\ShowArtistJsonPresenter;
use Symfony\Component\Routing\Annotation\Route;
use Symfony5\View\Artist\ShowArtistView;

/**
 * @Route("/artist/{artistId}", methods={"GET"}, requirements={"id"="\d+"})
 */
class ShowArtistController
{
    public function __invoke(
        ShowArtist $showArtist,
        ShowArtistJsonPresenter $presenter,
        ShowArtistView $showArtistView,

        int $artistId
    ){

        $request = new ShowArtistRequest();
        $request->artistId = $artistId;

        $showArtist->execute($request, $presenter);
        return $showArtistView->generateView($presenter->viewModel());
    }
}