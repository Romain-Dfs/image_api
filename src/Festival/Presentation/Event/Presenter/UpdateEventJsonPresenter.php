<?php

namespace Festival\Presentation\Event\Presenter;

use Festival\Domain\Event\UseCase\UpdateEvent\UpdateEventPresenter;
use Festival\Domain\Event\UseCase\UpdateEvent\UpdateEventResponse;
use Festival\Presentation\Event\ViewModel\UpdateEventJsonViewModel;

class UpdateEventJsonPresenter implements UpdateEventPresenter
{
    private UpdateEventJsonViewModel $viewModel;

    public function present(UpdateEventResponse $response): void
    {
        $this->viewModel = new UpdateEventJsonViewModel();

        if ( $this->viewModel->isUpdated = $response->isEventUpdated() ) {

            $event = $response->event();

            $this->viewModel->name = $event->name();
            $this->viewModel->description = $event->description();
            $this->viewModel->location = $event->location();
            $this->viewModel->date = $event->date();
            $this->viewModel->attendees = $event->attendees();
        } else {
            foreach ( $response->notification()->getErrors() as $error ) {
                $this->viewModel->errors[$error->fieldName()] = $error->message();
            }
        }
    }

    public function viewModel(): UpdateEventJsonViewModel
    {
        return $this->viewModel;
    }
}