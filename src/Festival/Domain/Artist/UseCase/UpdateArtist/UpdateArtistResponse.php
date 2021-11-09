<?php

namespace Festival\Domain\Artist\UseCase\UpdateArtist;

use Festival\Domain\Artist\Entity\Artist;
use Festival\SharedKernel\Error\Notification;

class UpdateArtistResponse
{
    private ?Artist $artist;
    private Notification $notification;

    public function __construct()
    {
        $this->artist = null;
        $this->notification = new Notification();
    }

    public function addError(string $fieldName, string $error)
    {
        $this->notification->addError($fieldName, $error);
    }

    public function notification(): Notification
    {
        return $this->notification;
    }

    public function setArtist(Artist $artist)
    {
        $this->artist = $artist;
    }

    public function artist(): ?Artist
    {
        return $this->artist;
    }
}
