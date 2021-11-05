<?php

namespace Festival\Presentation\User\Presenter;

use Festival\Presentation\User\ViewModel\LoginJsonViewModel;
use Festival\Domain\User\UseCase\Login\LoginPresenter;
use Festival\Domain\User\UseCase\Login\LoginResponse;

class LoginJsonPresenter implements LoginPresenter
{
    private LoginJsonViewModel $viewModel;

    public function present(LoginResponse $response): void
    {
        $this->viewModel = new LoginJsonViewModel();
        $this->viewModel->email = $response->user()?->email();
    }

    public function viewModel(): LoginJsonViewModel
    {
        return $this->viewModel;
    }
}