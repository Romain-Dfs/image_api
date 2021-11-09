<?php

namespace Festival\Domain\Event\UseCase\UpdateEvent;

use Festival\Domain\Event\Entity\Event;
use Festival\SharedKernel\Error\Notification;

class UpdateEventResponse
{
    private Notification $note;
    private bool $eventUpdate = false;
    private Event $event;

    public function __construct()
    {
        $this->note = new Notification();
    }

    public function addError(string $fieldName, string $error)
    {
        $this->note->addError($fieldName, $error);
    }

    public function notification(): Notification
    {
        return $this->note;
    }

    public function eventIsUpdate()
    {
        $this->eventUpdate = true;
    }

    public function isEventUpdated(): bool
    {
        return $this->eventUpdate;
    }

    public function setEvent(Event $event): void
    {
        $this->event = $event;
    }

    public function event(): Event
    {
        return $this->event;
    }
}
