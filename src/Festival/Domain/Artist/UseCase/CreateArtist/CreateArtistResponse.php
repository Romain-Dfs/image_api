<?php

namespace Festival\Domain\Artist\UseCase\CreateArtist;

use Festival\SharedKernel\Error\Notification;

class CreateArtistResponse
{
    private $note;
    private bool $clientSaved = false;

    public function __construct()
    {
        $this->note = new Notification();
    }

    public function addError(string $fieldName, string $error)
    {
        $this->note->addError($fieldName, $error);
    }

    public function notification(): Notification
    {
        return $this->note;
    }

    public function artistIsCreate()
    {
        $this->clientSaved = true;
    }

    public function isClientSaved(): bool
    {
        return $this->clientSaved;
    }

}
