<?php

namespace Festival\Presentation\Event\ViewModel;

class UpdateEventJsonViewModel
{
    public bool $isUpdated = false;
    public ?string $name;
    public ?string $description;
    public ?string $location;
    public ?\DateTime $date;
    public ?array $attendees;

    public array $errors;
}