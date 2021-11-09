<?php

namespace Festival\Presentation\Event\ViewModel;

class ShowEventJsonViewModel
{
    public string $name;
    public string $description;
    public string $location;
    public \DateTime $date;
    public array $attendees;

    public array $errors;
}