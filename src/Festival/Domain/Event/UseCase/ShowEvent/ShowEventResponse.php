<?php

namespace Festival\Domain\Event\UseCase\ShowEvent;

use Festival\Domain\Event\Entity\Event;
use Festival\SharedKernel\Error\Notification;

class ShowEventResponse
{
    private ?Event $event;
    private Notification $note;

    public function __construct()
    {
        $this->note = new Notification();
        $this->event = null;
    }

    public function addError(string $fieldName, string $error)
    {
        $this->note->addError($fieldName, $error);
    }

    public function notification(): Notification
    {
        return $this->note;
    }

    public function setEvent(Event $event): void
    {
        $this->event = $event;
    }

    public function event(): ?Event
    {
        return $this->event;
    }
}
