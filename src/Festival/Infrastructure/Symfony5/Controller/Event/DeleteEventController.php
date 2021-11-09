<?php

namespace Symfony5\Controller\Event;

use Festival\Domain\Event\UseCase\DeleteEvent\DeleteEvent;
use Festival\Domain\Event\UseCase\DeleteEvent\DeleteEventRequest;
use Festival\Presentation\Event\Presenter\DeleteEventJsonPresenter;
use Symfony\Component\Routing\Annotation\Route;
use Symfony5\View\Event\DeleteEventView;

/**
 * La classe DeleteEventController est appelée quand un utilisateur souhaite supprimer un évènement
 * L'évènement supprimé sera celui dont l'id est passé à la wildcard
 * @Route("/event/{eventId}", methods={"DELETE"})
 */
class DeleteEventController
{
    public function __invoke(
        DeleteEvent $deleteEvent,
        DeleteEventJsonPresenter $deleteEventPresenter,
        DeleteEventView $deleteEventView,
        int $eventId
    )
    {
        // On initialise un objet Request pour l'UC avec l'id de l'event à supprimer
        $deleteEventRequest = new DeleteEventRequest();
        $deleteEventRequest->eventId = $eventId;

        //On appelle la méthode execute de l'UC qui va s'occuper d'initialiser le présenter
        $deleteEvent->execute($deleteEventRequest, $deleteEventPresenter);

        //On affiche la vue
        return $deleteEventView->generateView($deleteEventPresenter->viewModel());

    }
}