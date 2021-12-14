<?php

namespace FileManager\Presentation\Image\Presenter;

use FileManager\Domain\Image\UseCase\GetImage\GetImagePresenterInterface;
use FileManager\Domain\Image\UseCase\GetImage\GetImageResponse;
use FileManager\Presentation\Image\ViewModel\GetImageJsonViewModel;

class GetImageJsonPresenter implements GetImagePresenterInterface
{

    private GetImageJsonViewModel $viewModel;

    public function present(GetImageResponse $response): void
    {
        $this->viewModel = new GetImageJsonViewModel();

        if ( $image = $response->image() ) {
            $this->viewModel->id = $image->id();
            $this->viewModel->cloudinaryId = $image->cloudinaryId();
            $this->viewModel->url = $image->url();
            $this->viewModel->format = $image->format();
        }

        foreach ( $response->notification()->getErrors() as $error ) {
            $this->viewModel->errors[$error->fieldName()] = $error->message();
        }
    }

    public function viewModel(): GetImageJsonViewModel
    {
        return $this->viewModel;
    }
}