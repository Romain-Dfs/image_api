<?php

namespace Festival\Presentation\Event\Presenter;

use Festival\Domain\Event\Entity\Event;
use Festival\Domain\Event\UseCase\ShowEventList\ShowEventListPresenter;
use Festival\Domain\Event\UseCase\ShowEventList\ShowEventListResponse;
use Festival\Presentation\Event\ViewModel\ShowEventListJsonViewModel;

class ShowEventListJsonPresenter implements ShowEventListPresenter
{
    private ShowEventListJsonViewModel $viewModel;

    public function present(ShowEventListResponse $response): void
    {
        $this->viewModel = new ShowEventListJsonViewModel();

        /** @var Event $event */
        foreach ($response->eventList() as $event) {
            $this->viewModel->eventList[] = [
                'name' => $event->name(),
                'description' => $event->description(),
                'location' => $event->location(),
                'date' => $event->date(),
                'attendees' => $event->attendees()
            ];
        }
    }

    public function viewModel(): ShowEventListJsonViewModel
    {
        return $this->viewModel;
    }
}