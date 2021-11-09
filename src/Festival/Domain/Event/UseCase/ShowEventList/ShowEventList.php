<?php

namespace Festival\Domain\Event\UseCase\ShowEventList;

use Festival\Domain\Event\Entity\Event;
use Festival\Domain\Event\Entity\EventRepository;

class ShowEventList implements ShowEventListInterface
{

   public function __construct(
       private EventRepository $eventRepository
   ){}

   public function execute(ShowEventListRequest $request, ShowEventListPresenter $presenter): void
   {
       $response = new ShowEventListResponse();

       $response->setEventList($this->eventRepository->getEventList());

       $presenter->present($response);
   }
}
