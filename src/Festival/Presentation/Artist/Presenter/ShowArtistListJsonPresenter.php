<?php

namespace Festival\Presentation\Artist\Presenter;

use Festival\Domain\Artist\Entity\Artist;
use Festival\Domain\Artist\UseCase\ShowArtistList\ShowArtistListPresenter;
use Festival\Domain\Artist\UseCase\ShowArtistList\ShowArtistListResponse;
use Festival\Presentation\Artist\ViewModel\ShowArtistListJsonViewModel;

class ShowArtistListJsonPresenter implements ShowArtistListPresenter
{
    private ShowArtistListJsonViewModel $viewModel;

    public function present(ShowArtistListResponse $response): void
    {
        $this->viewModel = new ShowArtistListJsonViewModel();

        // Pour chaque artiste dans l'objet réponse, on ajoute un élément au tableau d'artiste du viewModel
        /** @var Artist $artist */
        foreach ( $response->artistList() as $artist ) {
            $this->viewModel->artistList[] = [
                'artistName' => $artist->name(),
                'artistDescription' => $artist->description()
            ];
        }
    }

    public function viewModel(): ShowArtistListJsonViewModel
    {
        return $this->viewModel;
    }
}