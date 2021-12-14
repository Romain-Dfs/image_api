<?php

namespace Festival\Presentation\Image\Presenter;

use Festival\Domain\Image\UseCase\UploadImage\UploadImagePresenterInterface;
use Festival\Domain\Image\UseCase\UploadImage\UploadImageResponse;
use Festival\Presentation\Image\ViewModel\UploadImageJsonViewModel;

class UploadImageJsonPresenter implements UploadImagePresenterInterface
{

    private UploadImageJsonViewModel $viewModel;

    public function present(UploadImageResponse $response): void
    {
        $this->viewModel = new UploadImageJsonViewModel();
        $this->viewModel->imageId = $response->Id();
    }

    public function viewModel(): UploadImageJsonViewModel
    {
        return $this->viewModel;
    }
}