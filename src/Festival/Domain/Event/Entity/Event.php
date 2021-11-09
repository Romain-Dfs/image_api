<?php

namespace Festival\Domain\Event\Entity;

class Event
{
    private int $id;

    public function __construct(
        private string $name,
        private string $description,
        private string $location,
        private \DateTime $dateTime,
        private array $attendees
    )
    {}

    public function name(): string
    {
        return $this->name;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function location(): string
    {
        return $this->location;
    }

    public function date(): \DateTime
    {
        return $this->dateTime;
    }

    public function attendees(): array
    {
        return $this->attendees;
    }

    public function id(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }
}