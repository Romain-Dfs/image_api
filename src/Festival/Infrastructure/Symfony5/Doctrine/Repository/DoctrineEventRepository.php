<?php

namespace Symfony5\Doctrine\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Festival\Domain\Artist\Entity\Artist;
use Festival\Domain\Event\Entity\Event;
use Festival\Domain\Event\Entity\EventRepository;
use Symfony5\Doctrine\Entity\Event as EventEntity;
use Symfony5\Doctrine\Entity\Artist as ArtistEntity;

class DoctrineEventRepository extends ServiceEntityRepository implements EventRepository
{

    public function __construct(ManagerRegistry $registry, private DoctrineArtistRepository $artistRepository)
    {
        parent::__construct($registry, EventEntity::class);
    }

    public function getEventList(): array
    {
        $eventList = $this->findAll();

        return array_map(function(EventEntity $event) {
            return new Event(
                $event->getName(),
                $event->getDescription(),
                $event->getLocation(),
                $event->getDate(),
                $event->getAttendee()
            );
        }, $eventList);

    }

    public function createEvent(Event $event): void
    {
        $eventEntity = new EventEntity();
        $eventEntity->setName($event->name());
        $eventEntity->setDescription($event->description());
        $eventEntity->setLocation($event->location());
        $eventEntity->setDate($event->date());

        if ( !empty($event->attendees()) ) {
            /** @var Artist $attendee */
            foreach ($event->attendees() as $attendee) {
                $eventEntity->addAttendee( $this->artistRepository->findOneBy(['id' => $attendee]) );
            }
        }

        $this->getEntityManager()->persist($eventEntity);
        $this->getEntityManager()->flush();
    }

    /**
     * @param int $eventId
     * @return Event|null : Si un évènement correspond à l'id, on le retourne, sinon on retourne null
     */
    public function getEvent(int $eventId): ?Event
    {
        /** @var EventEntity $event */
        $event = $this->findOneBy(['id' => $eventId]);

        return $event ? new Event(
            $event->getName(),
            $event->getDescription(),
            $event->getLocation(),
            $event->getDate(),
            $event->getAttendee()
        ) : null ;
    }


    public function updateEvent(Event $event): Event
    {
        /** @var EventEntity $eventToUpdate */
        $eventToUpdate = $this->findOneBy(['id' => $event->id()]);
        $eventToUpdate->setName($event->name());
        $eventToUpdate->setDescription($event->description());
        $eventToUpdate->setLocation($event->location());
        $eventToUpdate->setDate($event->date());

        // On réinitialise la liste des artistes liés à l'évènement
        $eventToUpdate->removeAllAttendees();

        if ( !empty($event->attendees()) ) {
            /** @var Artist $attendee */
            foreach ($event->attendees() as $attendee) {
                $eventToUpdate->addAttendee( $this->artistRepository->findOneBy(['id' => $attendee]) );
            }
        }

        $this->getEntityManager()->persist($eventToUpdate);
        $this->getEntityManager()->flush();

        return new Event(
            $eventToUpdate->getName(),
            $eventToUpdate->getDescription(),
            $eventToUpdate->getLocation(),
            $eventToUpdate->getDate(),
            $eventToUpdate->getAttendee()
        );
    }

    /**
     * La méthode deleteEvent permet de supprimer un event
     * @param int $eventId : L'id de l'event à supprimer
     */
    public function deleteEvent(int $eventId): void
    {
        /** @var EventEntity $event */
        $event = $this->findOneBy(['id' => $eventId]);
        $this->getEntityManager()->remove($event);
        $this->getEntityManager()->flush();
    }
}