<?php

namespace Symfony5\Controller\Artist;

use Festival\Domain\Artist\Entity\Artist;
use Festival\Domain\Artist\UseCase\UpdateArtist\UpdateArtist;
use Festival\Domain\Artist\UseCase\UpdateArtist\UpdateArtistRequest;
use Festival\Presentation\Artist\Presenter\UpdateArtistJsonPresenter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony5\View\Artist\UpdateArtistView;

/**
 * Le controller UpdateArtist permet de mettre un jour un artist
 * @Route("/artist/{artistId}", methods={"PUT"})
 */
class UpdateArtistController
{
    public function __invoke(
        Request $request,

        UpdateArtist $updateArtist,
        UpdateArtistJsonPresenter $presenter,
        UpdateArtistView $view,
        int $artistId
    )
    {
        $bodyResponse = json_decode($request->getContent(), true);
        $newArtistName = $bodyResponse["artistName"] ?? null;
        $newArtistDescription = $bodyResponse["artistDescription"] ?? null;

        $updateArtistRequest = new UpdateArtistRequest();
        $updateArtistRequest->artist = new Artist($newArtistName, $newArtistDescription);
        $updateArtistRequest->artist->setId($artistId);

        $updateArtist->execute($updateArtistRequest, $presenter);
        return $view->generateView($presenter->viewModel());
    }
}