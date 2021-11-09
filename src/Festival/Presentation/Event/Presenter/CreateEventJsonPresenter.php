<?php

namespace Festival\Presentation\Event\Presenter;

use Festival\Domain\Event\UseCase\CreateEvent\CreateEventPresenter;
use Festival\Domain\Event\UseCase\CreateEvent\CreateEventResponse;
use Festival\Presentation\Event\ViewModel\CreateEventJsonViewModel;

class CreateEventJsonPresenter implements CreateEventPresenter
{
    private CreateEventJsonViewModel $viewModel;

    public function present(CreateEventResponse $response): void
    {
        $this->viewModel = new CreateEventJsonViewModel();

        foreach ($response->notification()->getErrors() as $error) {
            $this->viewModel->errors[$error->fieldName()] = $error->message();
        }
    }

    public function viewModel(): CreateEventJsonViewModel
    {
        return $this->viewModel;
    }
}