<?php

namespace Symfony5\Controller\Event;

use Festival\Domain\Event\UseCase\CreateEvent\CreateEventRequest;
use Festival\Domain\Event\UseCase\UpdateEvent\UpdateEvent;
use Festival\Domain\Event\UseCase\UpdateEvent\UpdateEventRequest;
use Festival\Presentation\Event\Presenter\UpdateEventJsonPresenter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony5\View\Event\UpdateEventView;

/**
 * @Route("/event/{eventId}", methods={"PUT"})
 */
class UpdateEventController
{
    public function __invoke(
        Request $request,

        UpdateEvent $updateEvent,
        UpdateEventJsonPresenter $updateEventPresenter,
        UpdateEventView $updateEventView,
        int $eventId
    )
    {
        $bodyResponse = json_decode($request->getContent(), true);

        $updateEventRequest = new UpdateEventRequest();

        $updateEventRequest->eventId = $eventId;
        $updateEventRequest->name = $bodyResponse["name"] ?? null;
        $updateEventRequest->description = $bodyResponse["description"] ?? null;
        $updateEventRequest->location = $bodyResponse["location"] ?? null;

        // Si la date n'est pas null
        $eventDate = $bodyResponse["date"] ?? null;

        if ( $eventDate ) {
            $date = \DateTime::createFromFormat('Y-m-!d H:i:s', $eventDate);
            // Si le format n'est pas bon, on sort une erreur
            if ( !$date ) {
                $updateEventRequest->validDateFormat = false;
            }
            $updateEventRequest->date = $date ?: null;
        } else {
            $updateEventRequest->date = null;
        }

        $updateEventRequest->attendees = $bodyResponse["attendees"] ?? null;

        $updateEvent->execute($updateEventRequest, $updateEventPresenter);
        return $updateEventView->generateView($updateEventPresenter->viewModel());

    }
}