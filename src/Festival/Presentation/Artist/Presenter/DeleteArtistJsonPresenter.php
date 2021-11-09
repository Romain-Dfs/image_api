<?php

namespace Festival\Presentation\Artist\Presenter;

use Festival\Domain\Artist\UseCase\DeleteArtist\DeleteArtistPresenter;
use Festival\Domain\Artist\UseCase\DeleteArtist\DeleteArtistResponse;
use Festival\Presentation\Artist\ViewModel\DeleteArtistJsonViewModel;

/**
 * La classe DeleteArtistJsonPresenter permet de convertir les données de notre Response (pas toujours interprétables), en données facilement interprétables
 * On évite donc à la vue de réaliser des opérations dans l'affichage, tout est traité ici 
 */
class DeleteArtistJsonPresenter implements DeleteArtistPresenter
{
    private DeleteArtistJsonViewModel $viewModel;

    /**
     * La méthode present permet de convertir les données de la Response afin d'initialiser le ViewModel
     */
    public function present(DeleteArtistResponse $response): void
    {
        $this->viewModel = new DeleteArtistJsonViewModel();

        $this->viewModel->isDelete = $response->isArtistDelete();

        foreach ($response->notification()->getErrors() as $error ) {
            $this->viewModel->errors[$error->fieldName()] = $error->message();
        }
    }

    /**
     * La méthode viewModel permet de retourner un ViewModel qui va contenir toutes les données à envoyer à la vue
     */
    public function viewModel(): DeleteArtistJsonViewModel
    {
        return $this->viewModel;
    }
}
