<?php

namespace Festival\Domain\Artist\UseCase\DeleteArtist;

use Festival\SharedKernel\Error\Notification;

/**
 * Notre classe DeleteArtistResponse permet de faire transiter des informations de notre UC DeleteArtist jusqu'à notre Presenter DeleteArtistJsonPresenter.
 * Le presenter convertira ensuite les données de notre Response en données interprétables facilement par la vue
 */
class DeleteArtistResponse
{
    private Notification $note;
    private bool $artistDelete = false;

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

    public function artistIsDelete()
    {
        $this->artistDelete = true;
    }

    public function isArtistDelete(): bool
    {
        return $this->artistDelete;
    }
}
