<?php

namespace FileManager\Presentation\Image\Presenter;

use FileManager\Domain\Image\UseCase\DeleteImage\DeleteImagePresenterInterface;
use FileManager\Domain\Image\UseCase\DeleteImage\DeleteImageResponse;
use FileManager\Presentation\Image\ViewModel\DeleteImageJsonViewModel;

class DeleteImageJsonPresenter implements DeleteImagePresenterInterface
{
    private DeleteImageJsonViewModel $viewModel;

    public function present(DeleteImageResponse $response): void
    {
        $this->viewModel = new DeleteImageJsonViewModel();
        $this->viewModel->isDeleted = $response->isDeleted();

        foreach ( $response->notification()->getErrors() as $error ) {
            $this->viewModel->errors[$error->fieldName()] = $error->message();
        }
    }

    public function viewModel(): DeleteImageJsonViewModel
    {
        return $this->viewModel;
    }
}