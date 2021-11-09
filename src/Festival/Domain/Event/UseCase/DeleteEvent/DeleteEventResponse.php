<?php

namespace Festival\Domain\Event\UseCase\DeleteEvent;

use Festival\SharedKernel\Error\Notification;

class DeleteEventResponse
{
    private Notification $note;
    private bool $eventDelete = false;

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

    public function eventIsDelete()
    {
        $this->eventDelete = true;
    }

    public function isEventDelete(): bool
    {
        return $this->eventDelete;
    }
}
