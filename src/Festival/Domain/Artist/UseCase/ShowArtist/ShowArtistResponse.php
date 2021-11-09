<?php

namespace Festival\Domain\Artist\UseCase\ShowArtist;

use Festival\Domain\Artist\Entity\Artist;
use Festival\SharedKernel\Error\Notification;

class ShowArtistResponse
{
    // On veut l'utilisateur qui correspond à l'id, il peut être nul si l'id est invalide
    private ?Artist $artist;
    private Notification $note;

    public function __construct()
    {
        $this->note = new Notification();
        $this->artist = null;
    }

    public function addError(string $fieldName, string $error)
    {
        $this->note->addError($fieldName, $error);
    }

    public function notification(): Notification
    {
        return $this->note;
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
