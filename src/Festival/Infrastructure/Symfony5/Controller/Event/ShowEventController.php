<?php

namespace Symfony5\Controller\Event;

use Festival\Domain\Event\UseCase\ShowEvent\ShowEvent;
use Festival\Domain\Event\UseCase\ShowEvent\ShowEventRequest;
use Festival\Presentation\Event\Presenter\ShowEventJsonPresenter;
use Symfony\Component\Routing\Annotation\Route;
use Symfony5\View\Event\ShowEventView;

/**
 * @Route("/event/{eventId}", methods={"GET"})
 */
class ShowEventController
{
    public function __invoke(
        ShowEvent $showEvent,
        ShowEventJsonPresenter $showEventPresenter,
        ShowEventView $showEventView,

        int $eventId
    )
    {
        $showEventRequest = new ShowEventRequest();
        $showEventRequest->eventId = $eventId;

        $showEvent->execute($showEventRequest, $showEventPresenter);
        return $showEventView->generateView($showEventPresenter->viewModel());
    }
}