<?php

namespace Festival\Domain\Event\UseCase\CreateEvent;

class CreateEventRequest
{
    public ?string $name;
    public ?string $description;
    public ?string $location;
    public ?\DateTime $date;

    public ?array $attendees;

    public bool $validDateFormat = true;
}
