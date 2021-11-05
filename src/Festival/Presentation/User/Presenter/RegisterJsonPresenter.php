<?php

namespace Festival\Presentation\User\Presenter;

use Festival\Domain\User\UseCase\Register\RegisterPresenter;
use Festival\Domain\User\UseCase\Register\RegisterResponse;
use Festival\Presentation\User\ViewModel\RegisterJsonViewModel;

class RegisterJsonPresenter implements RegisterPresenter
{
    private RegisterJsonViewModel $viewModel;

    public function present(RegisterResponse $response): void
    {
        $this->viewModel = new RegisterJsonViewModel();
        $this->viewModel->email = $response->user()->email();
    }

    public function viewModel(): RegisterJsonViewModel
    {
        return $this->viewModel;
    }
}