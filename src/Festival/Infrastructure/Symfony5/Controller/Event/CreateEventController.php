<?php

namespace Symfony5\Controller\Event;

use Festival\Domain\Event\UseCase\CreateEvent\CreateEvent;
use Festival\Domain\Event\UseCase\CreateEvent\CreateEventRequest;
use Festival\Presentation\Event\Presenter\CreateEventJsonPresenter;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony5\View\Event\CreateEventView;

/**
 * @Route("/event", methods={"POST"})
 */
class CreateEventController
{
    public function __invoke(
        Request $request,

        CreateEvent $createEvent,
        CreateEventJsonPresenter $createEventPresenter,
        CreateEventView $createEventView
    )
    {
        $bodyResponse = json_decode($request->getContent(), true);
        $eventName = $bodyResponse["name"] ?? null;
        $eventDescription = $bodyResponse["description"] ?? null;
        $eventLocation = $bodyResponse["location"] ?? null;
        $eventDate = $bodyResponse["date"] ?? null;
        $eventAttendees = $bodyResponse["attendees"] ?? null;

        $createEventRequest = new CreateEventRequest();
        $createEventRequest->name = $eventName;
        $createEventRequest->description = $eventDescription;
        $createEventRequest->location = $eventLocation;

        // Si la date n'est pas null
        if ( $eventDate ) {
            $date = \DateTime::createFromFormat('Y-m-!d H:i:s', $eventDate);
            // Si le format n'est pas bon, on sort une erreur
            if ( !$date ) {
                $createEventRequest->validDateFormat = false;
            }
            $createEventRequest->date = $date ?: null;
        } else {
            $createEventRequest->date = null;
        }

        $createEventRequest->attendees = $eventAttendees;

        $createEvent->execute($createEventRequest, $createEventPresenter);

        return $createEventView->generateView($createEventPresenter->viewModel());

    }
}