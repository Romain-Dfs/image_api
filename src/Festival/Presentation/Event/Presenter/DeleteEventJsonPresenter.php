<?php

namespace Festival\Presentation\Event\Presenter;

use Festival\Domain\Event\UseCase\DeleteEvent\DeleteEventPresenter;
use Festival\Domain\Event\UseCase\DeleteEvent\DeleteEventResponse;
use Festival\Presentation\Event\ViewModel\DeleteEventJsonViewModel;

class DeleteEventJsonPresenter implements DeleteEventPresenter
{
    private DeleteEventJsonViewModel $viewModel;

    public function present(DeleteEventResponse $response): void
    {
        $this->viewModel = new DeleteEventJsonViewModel();

        $this->viewModel->isDelete = $response->isEventDelete();

        foreach ($response->notification()->getErrors() as $error ) {
            $this->viewModel->errors[$error->fieldName()] = $error->message();
        }
    }

    public function viewModel(): DeleteEventJsonViewModel
    {
        return $this->viewModel;
    }
}