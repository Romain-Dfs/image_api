<?php

namespace Festival\Presentation\Artist\Presenter;

use Festival\Domain\Artist\UseCase\UpdateArtist\UpdateArtistPresenter;
use Festival\Domain\Artist\UseCase\UpdateArtist\UpdateArtistResponse;
use Festival\Presentation\Artist\ViewModel\UpdateArtistJsonViewModel;

class UpdateArtistJsonPresenter implements UpdateArtistPresenter
{

    private UpdateArtistJsonViewModel $viewModel;

    public function present(UpdateArtistResponse $response): void
    {
        $this->viewModel = new UpdateArtistJsonViewModel();
        $this->viewModel->artistName = $response->artist()?->name();
        $this->viewModel->artistDescription = $response->artist()?->name();

        foreach ( $response->notification()->getErrors() as $error ) {
            $this->viewModel->errors[$error->fieldName()] = $error->message();
        }
    }

    public function viewModel(): UpdateArtistJsonViewModel
    {
        return $this->viewModel;
    }
}