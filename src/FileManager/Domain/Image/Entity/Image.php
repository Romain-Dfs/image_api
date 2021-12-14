<?php

namespace FileManager\Domain\Image\Entity;

class Image
{
    public function __construct(
        private int $id,
        private string $url,
        private string $cloudinaryId,
        private string $format,
    ){}

    public function id(): int
    {
        return $this->id;
    }

    public function url(): string
    {
        return $this->url;
    }

    public function cloudinaryId(): string
    {
        return $this->cloudinaryId;
    }

    public function format(): string
    {
        return $this->format;
    }
}