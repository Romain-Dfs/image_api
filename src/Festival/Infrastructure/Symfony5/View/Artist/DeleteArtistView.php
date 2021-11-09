<?php

namespace Symfony5\View\Artist;

use Festival\Presentation\Artist\ViewModel\DeleteArtistJsonViewModel;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * La classe DeleteArtistView permet d'afficher les données traitées par le Presenter DeleteArtistJsonPresenter
 * Cette classe retourne simplement une Response, ici de type Json 
 */
class DeleteArtistView
{
    public function generateView(DeleteArtistJsonViewModel $viewModel): JsonResponse
    {
        return new JsonResponse($viewModel);
    }
}
