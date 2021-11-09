<?php

namespace Festival\Presentation\Artist\Presenter;

use Festival\Domain\Artist\UseCase\ShowArtist\ShowArtistPresenter;
use Festival\Domain\Artist\UseCase\ShowArtist\ShowArtistResponse;
use Festival\Presentation\User\ViewModel\ShowArtistJsonViewModel;

class ShowArtistJsonPresenter implements ShowArtistPresenter
{
    private ShowArtistJsonViewModel $viewModel;

    public function present(ShowArtistResponse $response): void
    {
        $this->viewModel = new ShowArtistJsonViewModel();

        if ( $artist = $response->artist() ) {
            $this->viewModel->artistName = $artist->name();
            $this->viewModel->artistDescription = $artist->description();
        }

        foreach ( $response->notification()->getErrors() as $error ) {
            $this->viewModel->errors[$error->fieldName()] = $error->message();
        }
    }

    public function viewModel(): ShowArtistJsonViewModel
    {
        return $this->viewModel;
    }
}