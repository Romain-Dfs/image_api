<?php

namespace FileManager\Presentation\Image\Presenter;

use FileManager\Domain\Image\UseCase\UpdateImage\UpdateImagePresenterInterface;
use FileManager\Domain\Image\UseCase\UpdateImage\UpdateImageResponse;
use FileManager\Presentation\Image\ViewModel\UpdateImageJsonViewModel;

class UpdateImageJsonPresenter implements UpdateImagePresenterInterface
{
    private UpdateImageJsonViewModel $viewModel;

    public function present(UpdateImageResponse $response): void
    {
        $this->viewModel = new UpdateImageJsonViewModel();
        $this->viewModel->isUpdate = $response->isUpdate();

        foreach ( $response->notification()->getErrors() as $error ) {
            $this->viewModel->errors[$error->fieldName()] = $error->message();
        }
    }

    public function viewModel(): UpdateImageJsonViewModel
    {
        return $this->viewModel;
    }
}