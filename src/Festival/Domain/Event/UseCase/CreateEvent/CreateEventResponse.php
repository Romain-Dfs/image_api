<?php

namespace Festival\Domain\Event\UseCase\CreateEvent;

use Festival\SharedKernel\Error\Notification;

class CreateEventResponse
{
    private Notification $note;
    private bool $eventSaved = false;

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

    public function eventIsCreate()
    {
        $this->eventSaved = true;
    }

    public function isEventSaved(): bool
    {
        return $this->eventSaved;
    }
}
