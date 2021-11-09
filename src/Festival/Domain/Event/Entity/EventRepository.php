<?php

namespace Festival\Domain\Event\Entity;

interface EventRepository
{
    public function getEventList(): array;
    public function createEvent(Event $event): void;
    public function getEvent(int $eventId): ?Event;
    public function updateEvent(Event $event): Event;
    public function deleteEvent(int $eventId): void;
}