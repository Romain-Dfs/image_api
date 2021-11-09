<?php

namespace Symfony5\Controller\Artist;


use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony5\View\Artist\CreateArtistView;
use Festival\Presentation\Artist\Presenter\CreateArtistJsonPresenter;
use Festival\Domain\Artist\UseCase\CreateArtist\CreateArtist;
use Festival\Domain\Artist\UseCase\CreateArtist\CreateArtistRequest;
use Symfony\Component\Routing\Annotation\Route;

/**
 * La classe CreateArtistController va récupérer une requête à l'url /artist de type POST qui va contenir les informations pour créer un nouvel artiste en DB
 * @Route("/artist", methods={"POST"})
 */
class CreateArtistController
{
    public function __invoke(
        Request $request,

        CreateArtist $createArtist,
        CreateArtistView $createArtistView,
        CreateArtistJsonPresenter $createArtistPresenter
    ){

        $bodyResponse = json_decode($request->getContent(), true);
        $artistName = $bodyResponse["name"] ?? null;
        $artistDescription = $bodyResponse["description"] ?? null;

        // On initialise la requête a l'aide des données récupérées dans le body de la requête
        $createArtistRequest = new CreateArtistRequest();
        $createArtistRequest->name = $artistName;
        $createArtistRequest->description = $artistDescription;

//        On appel la méthode execute de l'UC CreateArtist qui va initialiser le Presenter
        $createArtist->execute($createArtistRequest, $createArtistPresenter);
        return $createArtistView->generateView($createArtistPresenter->viewModel());
    }
}