<?php

namespace Festival\Domain\Event\UseCase\DeleteEvent;


use Festival\Domain\Event\Entity\EventRepository;

/**
 * La classe DeleteEvent est notre UC
 * C'est dans cette classe que s'effectue la logique métier
 */
class DeleteEvent implements DeleteEventInterface
{
    public function __construct(
        private EventRepository $eventRepository
    )
    {}

    /**
     * Notre méthode execute va s'occuper de vérifier que l'event à supprimer existe avant de le supprimer
     * @param DeleteEventRequest $request : La requête qui contient l'id de l'event à supprimer
     * @param DeleteEventPresenter $presenter : Le presenter qui va initialiser notre ViewModel à partir de l'objet Response
     */
    public function execute(DeleteEventRequest $request, DeleteEventPresenter $presenter): void
    {
        $response = new DeleteEventResponse();

        $isValid = $this->validateEventToBeDeleted($request, $response);

        if ( $isValid ) {
            $this->deleteEvent($request, $response);
        }

        $presenter->present($response);
    }

    private function validateEventToBeDeleted(DeleteEventRequest $request, DeleteEventResponse $response): bool
    {
        $event = $this->eventRepository->getEvent($request->eventId);
        $eventCanBeDelete = true;

        if ( !$event ) {
            $response->addError('eventNotFound', 'No event corresponds to the id you have indicated !');
            $eventCanBeDelete = false;
        }

        return $eventCanBeDelete;
    }

    private function deleteEvent(DeleteEventRequest $request, DeleteEventResponse $response): void
    {
        $this->eventRepository->deleteEvent($request->eventId);
        $response->eventIsDelete();
    }
}
