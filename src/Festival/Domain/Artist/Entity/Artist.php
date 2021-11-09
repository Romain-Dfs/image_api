<?php

namespace Festival\Domain\Artist\Entity;

class Artist
{
    private int $id;

    public function __construct(
        private ?string $name,
        private ?string $description
    ){}

    public function name(): ?string
    {
        return $this->name;
    }

    public function description(): ?string
    {
        return $this->description;
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