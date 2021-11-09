<?php

namespace Festival\Presentation\Event\Presenter;

use Festival\Domain\Event\UseCase\ShowEvent\ShowEventPresenter;
use Festival\Domain\Event\UseCase\ShowEvent\ShowEventResponse;
use Festival\Presentation\Event\ViewModel\ShowEventJsonViewModel;

class ShowEventJsonPresenter implements ShowEventPresenter
{
    private ShowEventJsonViewModel $viewModel;

    public function present(ShowEventResponse $response): void
    {
        $this->viewModel = new ShowEventJsonViewModel();

        if ( $event = $response->event() ) {
            $this->viewModel->name = $event->name();
            $this->viewModel->description = $event->description();
            $this->viewModel->location = $event->location();
            $this->viewModel->date = $event->date();
            $this->viewModel->attendees = $event->attendees();
        }

        foreach ( $response->notification()->getErrors() as $error ) {
            $this->viewModel->errors[$error->fieldName()] = $error->message();
        }
    }

    public function viewModel(): ShowEventJsonViewModel
    {
        return $this->viewModel;
    }
}