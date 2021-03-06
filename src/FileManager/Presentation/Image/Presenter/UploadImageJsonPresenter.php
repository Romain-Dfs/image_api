<?php

namespace FileManager\Presentation\Image\Presenter;

use FileManager\Domain\Image\UseCase\UploadImage\UploadImagePresenterInterface;
use FileManager\Domain\Image\UseCase\UploadImage\UploadImageResponse;
use FileManager\Presentation\Image\ViewModel\UploadImageJsonViewModel;

class UploadImageJsonPresenter implements UploadImagePresenterInterface
{

    private UploadImageJsonViewModel $viewModel;

    public function present(UploadImageResponse $response): void
    {
        $this->viewModel = new UploadImageJsonViewModel();
        $this->viewModel->imageId = $response->Id();

        foreach ( $response->notification()->getErrors() as $error ) {
            $this->viewModel->errors[$error->fieldName()] = $error->message();
        }
    }

    public function viewModel(): UploadImageJsonViewModel
    {
        return $this->viewModel;
    }
}