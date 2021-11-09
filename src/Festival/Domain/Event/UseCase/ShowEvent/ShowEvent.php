<?php

namespace Festival\Domain\Event\UseCase\ShowEvent;

use Festival\Domain\Event\Entity\EventRepository;

class ShowEvent implements ShowEventInterface
{

   public function __construct(
       private EventRepository $eventRepository
   )
   {}

   public function execute(ShowEventRequest $request, ShowEventPresenter $presenter): void
   {
       $response = new ShowEventResponse();

       $event = $this->eventRepository->getEvent($request->eventId);

       if ( $event ) {
           $response->setEvent($event);
       } else {
           $response->addError('askingEvent', 'No event corresponds to the entered id !');
       }

       $presenter->present($response);
   }
}
