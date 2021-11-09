<?php

namespace Festival\Domain\Event\UseCase\UpdateEvent;

class UpdateEventRequest
{
    public ?string $name;
    public ?string $description;
    public ?string $location;
    public ?\DateTime $date;
    public ?array $attendees;

    public int $eventId;
    public bool $validDateFormat = true;
}
