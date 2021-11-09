<?php

namespace Festival\Domain\Event\UseCase\CreateEvent;

use Festival\Domain\Artist\Entity\ArtistRepository;
use Festival\Domain\Event\Entity\Event;
use Festival\Domain\Event\Entity\EventRepository;

class CreateEvent implements CreateEventInterface
{

   public function __construct(
       private ArtistRepository $artistRepository,
       private EventRepository $eventRepository
   )
   {}

   public function execute(CreateEventRequest $request, CreateEventPresenter $presenter): void
   {
       $response = new CreateEventResponse();

        $this->createEvent($request, $response);

       $presenter->present($response);
   }

   private function createEvent(CreateEventRequest $request, CreateEventResponse $response): void
   {
       $isValid = $this->validateInputs($request, $response);

       // Si tout est valide et qu'il n'y a pas d'erreurs, on créé l'event
       if ( $isValid )
       {
           $this->saveEvent($request, $response);
       }
   }

   private function validateInputs(CreateEventRequest $request, CreateEventResponse $response): bool
   {
       $eventName = $request->name;
       $eventDescription = $request->description;
       $eventLocation = $request->location;
       $eventDate = $request->date;
       $eventAttendees = $request->attendees;
       $validFields = true;

       if ( !$eventName ) {
           $response->addError('name', 'The event name cannot be null or empty !');
           $validFields = false;
       }

       if ( !$eventDescription ) {
           $response->addError('description', 'The event description cannot be null or empty !');
           $validFields = false;
       }

       if ( !$eventLocation ) {
           $response->addError('location', 'The event location cannot be null or empty !');
           $validFields = false;
       }

        // S'il y a une une erreur de format, c'est que la date a été saisit et n'est donc pas vide
       if ( !$request->validDateFormat ) {
           $response->addError('date_format', 'The format of the date entered is not correct !');
           $validFields = false;
       } else {
           if ( !$eventDate ) {
               $response->addError('date', 'The event date cannot be null or empty !');
               $validFields = false;
           }
       }

       // Pour chaque numéro d'artiste, on doit vérifier qu'il existe
       if ( $eventAttendees ) {
           foreach ($eventAttendees as $attendee) {
               if (!$this->artistRepository->getArtist($attendee)) {
                   $response->addError('attendee_' . $attendee, 'No artist corresponds to the id entered');
                   $validFields = false;
               }
           }
       }

       return $validFields;
   }

   private function saveEvent(CreateEventRequest $request, CreateEventResponse $response): void
   {
       $attendees = $request->attendees ?: array();

       $event = new Event(
           $request->name,
           $request->description,
           $request->location,
           $request->date,
           $attendees
       );

       $this->eventRepository->createEvent($event);
       $response->eventIsCreate();
   }
}
