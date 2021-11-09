<?php

namespace Festival\Presentation\Artist\Presenter;

use Festival\Domain\Artist\UseCase\CreateArtist\CreateArtistPresenter;
use Festival\Domain\Artist\UseCase\CreateArtist\CreateArtistResponse;
use Festival\Presentation\Artist\ViewModel\CreateArtistJsonViewModel;
use Festival\Presentation\User\ViewModel\RegisterJsonViewModel;

class CreateArtistJsonPresenter implements CreateArtistPresenter
{
    private CreateArtistJsonViewModel $viewModel;

    public function present(CreateArtistResponse $response): void
    {
        $this->viewModel = new CreateArtistJsonViewModel();
        $this->viewModel->clientSaved = $response->isClientSaved();

        foreach ( $response->notification()->getErrors() as $error )
        {
            $this->viewModel->errors[$error->fieldName()] = $error->message();
        }
    }

    public function viewModel(): CreateArtistJsonViewModel
    {
        return $this->viewModel;
    }
}